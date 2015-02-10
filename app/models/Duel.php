<?php

class Duel extends \Eloquent {

    protected $fillable = [];

    public function course()
    {
        return $this->belongsTo('Course');
    }

    public function quiz()
    {
        return $this->belongsTo('Quiz');
    }

    public function defiant()
    {
        return $this->belongsTo('User');
    }

    public function opponent()
    {
        return $this->belongsTo('User');
    }

    public function winner()
    {
        return $this->belongsTo('User');
    }

}