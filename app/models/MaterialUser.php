<?php

class MaterialUser extends \Eloquent {
	protected $fillable = [];


	public function material()
	{
		return $this->belongsTo('Material');
	}


}