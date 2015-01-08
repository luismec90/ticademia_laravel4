<?php

class ReachedAchievement extends \Eloquent {

    protected $fillable = [];

    public function achievement()
    {
        return $this->belongsTo('Achievement');
    }

    public function course()
    {
        return $this->belongsTo('Course');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}