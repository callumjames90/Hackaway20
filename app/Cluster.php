<?php

namespace App;

class Cluster extends \Jenssegers\Mongodb\Eloquent\Model
{
    protected $fillable = ['review_id', 'latitude', 'longitude', 'rating_avg'];

    public function reviews() {
        return $this->hasMany('App\Review');
    }
}
