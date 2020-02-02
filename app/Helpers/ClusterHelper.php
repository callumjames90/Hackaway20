<?php

namespace App\Helpers;

use App\Review;
use App\Cluster;

class ClusterHelper {

    public static function get_cluster($review)
    {
        // Get all clusters (DB) if any, otherwise make self a cluster
        $clusters = Cluster::all();
        if (count($clusters) == 0) {
            // Add as cluster (link new cluster id with this)
//            echo "Init\n";
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
            $distance = ClusterHelper::get_distance($review, $cluster);
            if ($min > $distance) {
                $min_id = $cluster->_id;
                $min = $distance;
            }
        }

        $THRESHOLD = 0.08; // Approximately 80m
//        echo "Distance: " . $min;
        if ($min > $THRESHOLD) { // If deserving to be a new cluster
            // Add as cluster (link new cluster id with this)
//            echo "Over threshold " . $THRESHOLD . "\n";
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
//            echo ", close to " . $min_id . "\n";
            $cluster = Cluster::findOrFail($min_id);
            $cluster->reviews()->save($review);
            $cluster->rating_count = floatval($cluster->rating_count) + 1.0;
            $cluster->rating_avg = ClusterHelper::alter_rating($review->rating, $cluster);
            $cluster->save();
        }
    }

    private static function alter_rating($new, $cluster) {
        return (floatval($cluster->rating_avg) * (floatval($cluster->rating_count) - 1) + floatval($new))/(floatval($cluster->rating_count));
    }

    private static function get_longitude_radians($a) {
        return pi()*floatval($a->longitude)/180;
    }

    private static function get_latitude_radians($a) {
        return pi()*floatval($a->latitude)/90;
    }

    private static function get_distance($a, $b) {
        return acos(sin(ClusterHelper::get_latitude_radians($a)) * sin(ClusterHelper::get_latitude_radians($b)) + cos(ClusterHelper::get_latitude_radians($a)) *
                cos(ClusterHelper::get_latitude_radians($b)) * cos(ClusterHelper::get_longitude_radians($a) - ClusterHelper::get_longitude_radians($b))) * 6371;
    }
}

?>
