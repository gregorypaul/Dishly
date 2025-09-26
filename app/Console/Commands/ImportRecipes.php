<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Tag;

class ImportRecipes extends Command
{
  protected $signature = 'recipes:import {--letters=a-z}';
  protected $description = 'Import recipes from TheMealDB API';

  public function handle()
  {
    $letters = range('a', 'z');
    $user = User::first();

    if (!$user) {
      $this->error('No users found.');
      return;
    }

    foreach ($letters as $letter) {
      $this->info("Fetching recipes for letter: {$letter}");

      $response = Http::get("https://www.themealdb.com/api/json/v1/1/search.php?f={$letter}");

      if ($response->failed()) {
        $this->error("API request failed for letter {$letter}");
        continue;
      }

      $meals = $response->json()['meals'] ?? [];

      foreach ($meals as $meal) {
        // Collect up to 20 ingredients
        $ingredients = [];
        $measures = [];

        for ($i = 1; $i <= 20; $i++) {
          $ingredient = $meal["strIngredient{$i}"] ?? null;
          $measure = $meal["strMeasure{$i}"] ?? null;

          if ($ingredient && trim($ingredient) !== '') {
            $ingredients[] = trim($ingredient);
            $measures[] = trim($measure);
          }
        }

        $instructions = array_values(array_filter(array_map(function ($step) {
          return preg_replace('/^STEP\s*\d+[:\-]?\s*/i', '', trim($step));
        }, explode("\n", $meal['strInstructions'] ?? ''))));

        $tags = $meal['strTags']
          ? array_map('trim', explode(',', $meal['strTags']))
          : [];

        $recipe = Recipe::updateOrCreate(
          ['title' => $meal['strMeal']], // unique by title
          [
            'category'      => $meal['strCategory'] ?? null,
            'ingredients'  => $ingredients, // ✅ JSON array
            'instructions' => $instructions,
            'measures'      => $measures,
            'image_url'    => $meal['strMealThumb'] ?? null,
            'user_id'      => $user->id,
            'youtube'       => $meal['strYoutube'] ?? null,
            'source'        => $meal['strSource'] ?? null,
          ]
        );
        if (!empty($tags)) {
          // Get or create all tag IDs in one pass
          $tagIds = [];
          foreach ($tags as $tagName) {
            $tag = \App\Models\Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
          }

          // Attach all tags for this recipe
          $recipe->tags()->sync($tagIds);
        }
      }
    }

    $this->info('Recipes imported successfully');
  }
}
