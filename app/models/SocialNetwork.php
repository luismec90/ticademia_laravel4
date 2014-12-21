<?php

class SocialNetwork extends \Eloquent {
	protected $fillable = [];

	public function user()
	{
		return $this->belongsTo('user');
	}
}