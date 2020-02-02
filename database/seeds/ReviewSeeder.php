<?php

use App\Review;
use App\Cluster;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $csvFileName = "Coord.csv";
        $csvFile = public_path('../database/seeds/' . $csvFileName);
        $lines = $this->read_csv($csvFile,array('delimiter' => ','));
        foreach ($lines as $line) {
            if (!$line) break;
            $review = new Review([
                'created_at' => str_replace('T', ' ', explode('.', $line[2])[0]),
                'latitude' => $line[0],
                'longitude' => $line[1],
                'rating' => random_int(0, 5),
                'details' => Str::random(20)
            ]);
            $review->save();
            $this->get_cluster($review);
        }
    }

    private function get_reviews() {
        return json_decode($this->curl_request("GET", "https://api.radar.io/v1/users"))->users;
    }

    private function get_cluster($review)
    {
        // Get all clusters (DB) if any, otherwise make self a cluster
        $clusters = Cluster::all();
        if (count($clusters) == 0) {
            // Add as cluster (link new cluster id with this)
            $cluster = new Cluster([
                'review_id' => $review->id,
                'latitude' => $review->latitude,
                'longitude' => $review->longitude,
                'rating_avg' => $review->rating,
                'rating_count' => 1
            ]);
            $cluster->save();
            $cluster->reviews()->save($review);
            return;
        }

        // For all clusters, use lat_long to get distance
        $min = 180;
        $min_id = -1;
        foreach ($clusters as $cluster) {
            $distance = $this->get_distance($review, $cluster);
            if ($min > $distance) {
                $min_id = $cluster->_id;
                $min = $distance;
            }
        }

        $THRESHOLD = 4;
        if ($min > $THRESHOLD) { // If deserving to be a new cluster
            // Add as cluster (link new cluster id with this)
            $cluster = new Cluster([
                'review_id' => $review->id,
                'latitude' => $review->latitude,
                'longitude' => $review->longitude,
                'rating_avg' => $review->rating,
                'rating_count' => 1
            ]);
            $cluster->save();
            $cluster->reviews()->save($review);
            return;
        } else {
            $cluster = Cluster::findOrFail($min_id);
            $cluster->reviews()->save($review);
            $cluster->rating_count = floatval($cluster->rating_count) + 1.0;
            $cluster->rating_avg = $this->alter_rating($review->rating, $cluster);
            $cluster->save();
        }
    }

    private function alter_rating($new, $cluster) {
        return (floatval($cluster->rating_avg) * (floatval($cluster->rating_count) - 1) + floatval($new))/(floatval($cluster->rating_count));
    }

    private function get_longitude_radians($a) {
        return pi()*$a->longitude/180;
    }

    private function get_latitude_radians($a) {
        return pi()*$a->longitude/90;
    }

    private function get_distance($a, $b) {
        return acos(sin(floatval($a->latitude)) * sin(floatval($b->latitude)) + cos(floatval($a->latitude)) *
                cos(floatval($b->latitude)) * cos(floatval($a->longitude) - floatval($b->longitude))) * 6371;
    }

    private function read_csv($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }
}
