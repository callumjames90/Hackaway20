<?php

use App\Review;
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
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.radar.io/v1/users",
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
        $data = json_decode($response)->users;
        //$data[0];
        curl_close($curl);

        foreach ($data as $input) {
            $review = [
                'radar_id' => $input->_id,
                'created_at' => str_replace('T', ' ', explode('.', $input->createdAt)[0]),
                // location	-> co-ordinates (lat, long) [actually cluster]
                'rating' => random_int(0, 5),
                'details' => Str::random(20)
            ];
            DB::table('reviews')->insert($review);
        }

        /*
            location	-> co-ordinates (lat, long) [actually cluster]
            created_at
            id
            deviceId	-> userid
            {null}		-> details
            {null}		-> rating
         */

    }
}
