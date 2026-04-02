<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Message;
use App\Models\ConversationThread;
use App\Models\Notification;
use App\Policies\MessagePolicy;
use App\Policies\ConversationThreadPolicy;
use App\Policies\NotificationPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(\App\Providers\RouteServiceProvider::class);
        
        // Register authorization policies
        \Illuminate\Support\Facades\Gate::policy(Message::class, MessagePolicy::class);
        \Illuminate\Support\Facades\Gate::policy(ConversationThread::class, ConversationThreadPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(Notification::class, NotificationPolicy::class);
    }
}
