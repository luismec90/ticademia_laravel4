<?php

class WallMessage extends \Eloquent {

    protected $fillable = [];

    public function replies()
    {
        return $this->hasMany('WallMessage')->orderBy('created_at', 'ASC');
    }

    public function user()
    {
        return $this->belongsTo('user');
    }
    public function course()
    {
        return $this->belongsTo('Course');
    }

    public function reachedAchievement()
    {
        return $this->belongsTo('ReachedAchievement');
    }

}