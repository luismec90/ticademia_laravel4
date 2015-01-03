<?php

class ApprovedQuiz extends \Eloquent {

    protected $fillable = [];

    public function approvedQuiz()
    {
        return $this->belongsTo('Quiz');
    }
}