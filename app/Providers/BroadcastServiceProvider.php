<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');

        Broadcast::channel('user.{id}', function ($user, $id) {
            \Illuminate\Support\Facades\Log::info("User {$user->id} is attempting to access channel for user {$id}");
            return (int) $user->id === (int) $id;
        });
    }
}
