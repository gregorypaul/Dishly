<?php

namespace App\Filament\Widgets;

use App\Models\Recipe;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentRecipes extends BaseWidget
{
  protected static ?int $sort = 2; // appears after stats

  public function table(Tables\Table $table): Tables\Table
  {
    return $table
      ->query(Recipe::latest()->take(5))
      ->columns([
        Tables\Columns\TextColumn::make('name')->label('Recipe'),
        Tables\Columns\TextColumn::make('user.name')->label('Author'),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime('M d, Y')
          ->label('Added On'),
      ]);
  }
}
