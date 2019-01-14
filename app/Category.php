<?php

namespace App;

class Category extends Model
{
	public $timestamps = false;
	
    public function recipes()
    {
    	return $this->hasMany(Recipe::class);
    }
}
