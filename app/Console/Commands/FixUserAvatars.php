<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class FixUserAvatars extends Command
{
  protected $signature = 'avatars:fix';
  protected $description = 'Convert full avatar URLs to relative storage paths';

  public function handle()
  {
    $users = User::whereNotNull('avatar')->get();

    foreach ($users as $user) {
      $original = $user->avatar;

      // If it already looks relative, skip
      if (!str_contains($original, 'http')) {
        $this->info("Skipping {$user->email}, already relative.");
        continue;
      }

      // Extract the relative path after /storage/
      $newPath = str_replace(url('storage') . '/', '', $original);

      if ($newPath !== $original) {
        $user->avatar = $newPath;
        $user->save();

        $this->info("Fixed avatar for {$user->email}: $newPath");
      }
    }

    $this->info("All done!");
  }
}
