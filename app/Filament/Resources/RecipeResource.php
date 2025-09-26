<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\HtmlString;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // If admin, show all
        if (auth()->user()?->hasRole('admin')) {
            return $query;
        }

        // Otherwise, only show the logged-in user's recipes
        return $query->where('user_id', auth()->id());
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Grid::make(2)->schema([ // 2 columns
                TextInput::make('title')->required(),
                Textarea::make('description'),
            ]),
            Grid::make(1)->schema([ // single column
                Textarea::make('ingredients')->required(),
                RichEditor::make('instructions')->required(),
                FileUpload::make('image_url')
                    ->image()
                    ->directory('recipes')
                    ->label('Recipe Image')
                    ->columnSpan('full'),

                Placeholder::make('preview')
                    ->label('Preview')
                    ->content(fn ($record) => $record && $record->image_url 
                        ? new HtmlString("<img src='{$record->image_url}' alt='Preview' style='max-width:125px; border-radius:8px;'>")
                        : 'No image available')
                    ->columnSpan('full'),
            ]),
            Select::make('user_id')
                ->relationship('user', 'name')
                ->default(fn () => auth()->id())
                ->visible(fn () => auth()->user()?->hasRole('admin')) // only show dropdown for admins
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                ->label('Image')
                ->square()
                ->size(50),
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
