<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'RecipesController@index');

Route::get('/dodaj', 'RecipesController@create');
Route::post('/', 'RecipesController@store');

Route::get('/recept/{recipe}', 'RecipesController@show')->name('display');

Route::get('/kategorija/{category}', 'CategoriesController@show')->name('category');

Route::get('/suggest', function() {
	$categories = \App\Category::all();
	foreach ($categories as $category) {
		$suggestions[] = ucfirst($category->name); 
	}

	$response['suggestions'] = $suggestions;

	return $response; 
});

Route::match(['get', 'post'], '/pretraga', 'RecipesController@search');

Route::post('/get-recipes', function() {
	$ids = request('ids');
	$recipes = [];
	$i = 0;
	foreach ($ids as $id) {
		$recipe = \App\Recipe::find((int)$id);
		$recipes[$i]['title'] = $recipe->title;
		$recipes[$i]['ingredients'] = $recipe->ingredients;
		$recipes[$i]['instructions'] = $recipe->instructions;
		$i++;
	}
	
	return $recipes;
});

Route::post('/get-ingredients', function() {
	$ids = request('ids');
	$ingredients = [];
	foreach ($ids as $id) {
		$recipe = \App\Recipe::find((int)$id);
		$ings = $recipe->ingredients;
		foreach ($ings as $ing) {
			$ingredients[$ing->name][] = $ing->pivot->qty;
		}
	}

	foreach ($ingredients as $key => $ing) {
		$sum = 0;
		$unit = '';
		for ($i = 0; $i < count($ing); $i++) {
			$amount = intval(preg_replace('/[^0-9]+/', '', $ing[$i]));
			$unit = preg_replace('/[^a-zA-z]+/', '', $ing[$i]);
			$sum += $amount;
		}
		$response[$key] = $sum . ' ' . $unit;
	}
	
	return $response;
});
