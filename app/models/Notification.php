<?php

class Notification extends \Eloquent {

    protected $fillable = [];

    public function reachedAchievement()
    {
        return $this->belongsTo('ReachedAchievement');
    }
}