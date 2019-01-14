<?php

namespace App\Http\Controllers;

use Request;
use App\Recipe;
use App\Ingredient;
use App\Category;

class RecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::orderByRaw('RAND()')->take(5)->get();
        return view('home', compact('recipes'));
    }

    public function create()
    {
    	return view('recipes.create');
    }

    public function store()
    {
        $ings = request(['ing']);
        $type = $ings['ing']['type'];
        $qty = $ings['ing']['qty'];

        $recipe = new Recipe(request(['title', 'instructions']));
        
        $category = Category::firstOrCreate(['name' => strtolower(request('category'))]);
        $recipe->category()->associate($category);
        $imageName = '';
        if (request()->file('image') !== null ) {
            $imageName = str_replace(' ', '_', strtolower(request('title')));
            $imageName .= '.' . request()->file('image')->getClientOriginalExtension();
            request()->file('image')->storeAs('recipes', $imageName, 'public');
        }
        $recipe->image = $imageName;
        $recipe->save();

        for($i = 0; $i < sizeof($type); $i++) {
            $ingredient = Ingredient::firstOrCreate(['name' => strtolower($type[$i])]);

            $recipe->ingredients()->attach($ingredient, ['qty' => strtolower($qty[$i])]);
        }

        return redirect()->route('display', $recipe);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function search()
    {
        $search = request('search');

        if(Request::ajax()) {
            $recipes = \App\Recipe::where('title', 'like', '%'. $search . '%')
                ->orderBy('title')
                ->limit(5)
                ->get();

            $response = array();
            if ($recipes->count()) {
                for($i = 0; $i < count($recipes); $i++) {
                    $response['suggestions'][$i]['value'] = $recipes[$i]->title;
                    $response['suggestions'][$i]['data'] = route('display', $recipes[$i]);
                }
            } else {
                $response['suggestions'] = [];
            }

            return json_encode($response);
        } else {
            $recipes = \App\Recipe::where('title', 'like', '%'. $search . '%')
                ->orderBy('title')
                ->get();
        }

        return view('recipes.search', compact('recipes'));
    }
}
