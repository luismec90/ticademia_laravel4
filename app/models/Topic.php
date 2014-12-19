<?php

class Topic extends \Eloquent {

    protected $fillable = [];


    public function user()
    {
        return $this->belongsTo('user');
    }
}