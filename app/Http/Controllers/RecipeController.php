<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    // show all recipes
    public function index(Request $request) 
    {
      $query = Recipe::query();

      if($request->filled('category')) {
        $query->where('category', $request->category);
      }

      $recipes = Recipe::latest()->paginate(12);

    // Collect distinct categories + count
      $categories = Recipe::selectRaw('category, COUNT(*) as total')
        ->whereNotNull('category')
        ->groupBy('category')
        ->pluck('total', 'category')
        ->toArray();


    return view('recipes.index', compact('recipes', 'categories'));
    }
    // show 1 recipe
    public function show(Recipe $recipe) 
    {
        $averageRating = $recipe->averageRating('score') ?? 0;
        $voteCount = $recipe->ratings()->count();

        $userRating = null;

        if(auth()->check()) {
            $userRating = $recipe->ratings()
                                 ->where('user_id', auth()->id())
                                 ->value('score');
        }
        // If instructions are stored as a string, split them into steps
        if (is_string($recipe->instructions)) {
            $recipe->instructions = explode("\n", $recipe->instructions);
        }

        // Clean up each step
        $recipe->instructions = array_values(array_filter(array_map(function ($step) {
            return preg_replace('/^STEP\s*\d+[:\-]?\s*/i', '', trim($step));
        }, $recipe->instructions)));

        $relatedRecipes = Recipe::where('id', '!=', $recipe->id)
            ->whereHas('tags', function ($query) use ($recipe) {
                $query->whereIn('tags.id', $recipe->tags->pluck('id'));
            })
            ->inRandomOrder()
            ->take(8)
            ->get();
            $title = 'Related Recipes';

        if ($relatedRecipes->isEmpty()) {
            $relatedRecipes = Recipe::where('id', '!=', $recipe->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
            $title = 'Other Recipes You Might Like';
        }

        return view('recipes.show', compact('recipe', 'relatedRecipes', 'averageRating', 'voteCount', 'userRating', 'title'));        
    }
    // only show form for logged in users
    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|max2048', // file upload
            'description' => 'nullable|string',
        ]);

        $path = null;
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('recipes', 'public');
        }

        $recipe = Recipe::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'ingredients' => $validated['ingredients'],
            'instructions' => $validated['instructions'],
            'image_url' => $path ? \asset('storage/'.$path) : null,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('recipes.show', $recipe)
        ->with('success', 'Recipes added successfully!');
    }
}
