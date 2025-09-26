<?php

namespace App\Http\Controllers;
use App\Models\Recipe;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredRecipes = Recipe::inRandomOrder()->take(6)->get();
        return view('home' , compact('featuredRecipes'));
    }
}
