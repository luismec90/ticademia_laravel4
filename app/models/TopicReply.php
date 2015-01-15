<?php

class TopicReply extends \Eloquent {

    protected $fillable = [];


    public function user()
    {
        return $this->belongsTo('user');
    }

    public function topic()
    {
        return $this->belongsTo('Topic');
    }

    public function likes()
    {
        return $this->hasMany('Like');
    }

    public function myLikes()
    {
        return $this->hasMany('Like')->where('user_id', Auth::user()->id);
    }
}