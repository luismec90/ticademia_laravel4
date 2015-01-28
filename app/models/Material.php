<?php

class Material extends \Eloquent {

    protected $fillable = [];

    public static $videoRules = [
        'name' => 'required',
        'type' => 'required',
        'url'  => 'required'
    ];

    public function reviews()
    {
        return $this->hasMany('Review');
    }

    public function module()
    {
        return $this->belongsTo('Module');
    }

    public function reviewsWithComments()
    {
        return $this->hasMany('Review')
            ->where('comment', '<>', '');
    }

    public function userReviews()
    {
        return $this->hasMany('Review')
            ->where('user_id', Auth::user()->id);
    }

    public function recalculateRating()
    {
        $reviews = $this->reviews();
        $avgRating = $reviews->avg('rating');
        $this->rating_cache = round($avgRating, 1);
        $this->rating_count = $reviews->count();
        $this->save();
    }

    public function userPlayBackTime()
    {
        return $this->hasMany('MaterialUser')
            ->where('user_id', Auth::user()->id)
            ->selectRaw('material_id, SUM(playback_time) AS playback_time')
            ->groupBy('material_id');
    }

    public function iconPath()
    {
        if ($this->type == "video")
            return asset('assets/images/course/video-icon.png');
        else
            return asset('assets/images/course/pdf-icon.png');
    }

    public function quizzes()
    {
        return $this->belongsToMany('quiz');
    }
}