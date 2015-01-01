<?php

class Module extends \Eloquent {

    protected $fillable = [];

    public function materials()
    {
        return $this->hasMany('Material');
    }

    public function quizzes()
    {
        return $this->hasMany('Quiz');
    }

}