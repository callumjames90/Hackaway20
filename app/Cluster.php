<?php

namespace App;

class Cluster extends \Jenssegers\Mongodb\Eloquent\Model
{
    protected $fillable = ['review_id'];

    public function reviews() {
        return $this->hasMany('App\Review');
    }
}
