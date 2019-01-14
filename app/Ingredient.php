<?php

namespace App;

class Ingredient extends Model
{
	public $timestamps = false;
	
    public function recipes()
    {
    	return $this->belongsToMany(Recipe::class)->withPivot('qty');
    }
}
