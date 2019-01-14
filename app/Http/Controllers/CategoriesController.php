<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
    	$recipes = Recipe::where('category_id', $category->id)
    		->orderBy('title')
    		->get();

    	return view('categories.show', compact('recipes', 'category'));
    }
}
