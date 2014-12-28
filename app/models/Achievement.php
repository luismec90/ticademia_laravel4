<?php

class Achievement extends \Eloquent {
	protected $fillable = [];

	public function imagePath()
	{
		return asset('assets/images/course/achievements/' . $this->id.'.png');
	}
}