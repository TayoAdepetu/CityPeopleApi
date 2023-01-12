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
        //https://stackoverflow.com/questions/41728930/laravel-broadcasting-auth-always-fails-with-403-error
        Broadcast::routes(['middleware' => [JWTAuthMiddleware::class]]);

        require base_path('routes/channels.php');
    }
}
