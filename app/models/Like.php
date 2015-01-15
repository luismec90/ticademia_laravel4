<?php

class Like extends \Eloquent {

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function wallMessage()
    {
        return $this->belongsTo('WallMessage');
    }

    public function topicReply()
    {
        return $this->belongsTo('TopicReply');
    }
}