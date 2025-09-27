<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class BackfillUserAvatars extends Command
{
  
  /**
  * The name and signature of the console command.
  *
  * @var string
  */
  protected $signature = 'users:backfill-avatars';
  
  /**
  * The console command description.
  *
  * @var string
  */
  protected $description = 'Assign DiceBear avatars to users missing one';
  
  /**
  * Execute the console command.
  */
  public function handle()
  {
    $users = User::whereNull('avatar')->get();

    foreach($users as $user) {
      $user->avatar = 'https://api.dicebear.com/7.x/avataaars/svg?seed=" . uniqid()';
      $user->save();
      $this->info("Avatar assigned for user: {$user->email}");
    }
    $this->info("Backfill complete!");
    return Command::SUCCESS;
  }
}
