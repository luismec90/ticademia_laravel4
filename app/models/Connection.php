<?php

class Connection extends \Eloquent {

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function course()
    {
        return $this->belongsTo('Course');
    }
}