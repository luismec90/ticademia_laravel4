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
}