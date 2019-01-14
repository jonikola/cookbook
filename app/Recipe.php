<?php

namespace App;

class Recipe extends Model
{
    public function ingredients()
    {
    	return $this->belongsToMany(Ingredient::class)->withPivot('qty');
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
