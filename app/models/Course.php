<?php

class Course extends \Eloquent {

    protected $fillable = [];

    public function subject()
    {
        return $this->belongsTo('subject');
    }
}