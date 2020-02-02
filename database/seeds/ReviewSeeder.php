<?php

use App\Review;
use App\Cluster;
use App\Helpers\ClusterHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

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
            User::all()->random(1)[0]->reviews()->save($review);
            ClusterHelper::get_cluster($review);
        }
    }

    // Legacy function for retrieving data from Radar's API
    private function get_reviews() {
        return json_decode($this->curl_request("GET", "https://api.radar.io/v1/users"))->users;
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
