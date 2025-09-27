<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Facades\Hash;

class MyProfile extends Page
{
  use InteractsWithForms;

  protected static ?string $navigationIcon = 'heroicon-o-document-text';
  protected static ?string $title = 'My Profile Page';
  protected static string $view = 'filament.pages.my-profile';
  protected static ?string $label = 'My Profile';

  public ?array $data = [];

  public function mount(): void
  {
    $this->form->fill(auth()->user()->only([
      'name', 'email', 'avatar', 'bio', 'location'
    ]));
  }

  public function form(Form $form): Form
  {
    return $form
      ->Schema([
      Forms\Components\TextInput::make('name')->required(),
      Forms\Components\TextInput::make('email')->email()->required(),
      Forms\Components\TextInput::make('password')
        ->password()
        ->label('New Password')
        ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
        ->nullable(),
      Forms\Components\FileUpload::make('avatar')
        ->image()
        ->directory('avatar')
        ->avatar()
        ->label('Profile picture'),
      Forms\Components\Textarea::make('bio')->label('Bio'),
      Forms\Components\TextInput::make('location')->label('Location'),
    ])
    ->statePath('data');
  }

  public function save(): void
  {
    $user = auth()->user();
    $data = $this->form->getState();

    if (empty($data['password'])) {
      unset($data['password']);
    }

    $user->update($data);

    $this->notify('success', 'Profile udpated successfully!');
  }

  public static function shouldRegisterNavigation(): bool
  {
      return auth()->user()?->hasRole('user');
  }

}
