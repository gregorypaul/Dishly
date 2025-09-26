<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {

        $request->validate([
            'score' => 'required|integer|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            ['recipe_id' => $recipe->id, 'user_id' => auth()->id()],
            ['score' => $request->score],
        );

        return response()->json([
            'success' => true,
            'avg' => round($recipe->ratings()->avg('score'), 1),
            'votes' => $recipe->ratings()->count(),
        ]);    
    }
}
