<?php

class ReachedAchievement extends \Eloquent {

    protected $fillable = [];

    public function achievement()
    {
        return $this->belongsTo('achievement');
    }

}