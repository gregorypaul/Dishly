<?php

namespace App\Filament\Widgets;

use App\Models\Recipe;
use App\Models\User;
use App\Models\Rating;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
  protected static ?int $sort = 0; // shows first

  protected function getCards(): array
  {
    return [
      Card::make('Total Recipes', Recipe::count())
        ->description('All recipes in the system')
        ->descriptionIcon('heroicon-m-book-open')
        ->color('success'),

      Card::make('Total Users', User::count())
        ->description('Registered users')
        ->descriptionIcon('heroicon-m-user-group')
        ->color('primary'),

      Card::make('Avg. Recipe Rating', number_format(Rating::avg('score') ?? 0, 1))
        ->description('Across all ratings')
        ->descriptionIcon('heroicon-m-star')
        ->color('warning'),
    ];
  }
}
