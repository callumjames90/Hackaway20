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
        $csvFile = public_path('..\\database\seeds\\' . $csvFileName);
        $lines = $this->readCSV($csvFile,array('delimiter' => ','));
        foreach ($lines as $line) {
            if (!$line) break;
            $review = [
                'created_at' => str_replace('T', ' ', explode('.', $line[2])[0]),
                'latitude' => $line[0],
                'longitude' => $line[1],
                'rating' => random_int(0, 5),
                'details' => Str::random(20)
            ];
            DB::table('reviews')->insert($review);
        }
    }

    private function get_reviews() {
        return json_decode($this->curl_request("GET", "https://api.radar.io/v1/users"))->users;
    }

    private function get_cluster($input) {
        $coordinates = $input->location->coordinates;

        // Get all clusters (DB) if any, otherwise make self a cluster
        $clusters = Cluster::all();
        if (count($clusters) == 0) {
            // add as cluster (link new cluster id with this)

        }

        // For all clusters, use lat_long to get distance

        // If min_distance > threshold, make new cluster
        // Else get cluster_id => min_distance
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.radar.io/v1/geofences",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: prj_live_sk_a9d412a222e6eff755691870f8f2d04070ff3124"
            )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response);
    }

    /*
     *  CREATE TABLE `markers` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
          `name` VARCHAR( 60 ) NOT NULL ,
          `address` VARCHAR( 80 ) NOT NULL ,
          `lat` FLOAT( 10, 6 ) NOT NULL ,
          `lng` FLOAT( 10, 6 ) NOT NULL ,
          `type` VARCHAR( 30 ) NOT NULL
        ) ENGINE = MYISAM ;
     */

    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }
}
