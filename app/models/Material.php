<?php

class Material extends \Eloquent {

    protected $fillable = [];

    public function reviews()
    {
        return $this->hasMany('Review');
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
}