<?php

class Course extends \Eloquent {

    protected $fillable = [];

    public function subject()
    {
        return $this->belongsTo('Subject');
    }

    public function wallMessages()
    {
        return $this->hasMany('WallMessage')->whereNull('wall_message_id')->orderBy('created_at','DESC');
    }
}