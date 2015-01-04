<?php

class ApprovedQuiz extends \Eloquent {

    protected $fillable = [];

    public function quiz()
    {
        return $this->belongsTo('Quiz');
    }
}