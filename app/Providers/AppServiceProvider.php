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
        $this->app->register(\Illuminate\Filesystem\FilesystemServiceProvider::class);
        $this->app->register(\Illuminate\View\ViewServiceProvider::class);
        $this->app->register(\Illuminate\Routing\RoutingServiceProvider::class);
        $this->app->register(\Illuminate\Auth\AuthServiceProvider::class);
        $this->app->register(\Illuminate\Database\DatabaseServiceProvider::class);
        $this->app->register(\Illuminate\Session\SessionServiceProvider::class);
        $this->app->register(\Illuminate\Cookie\CookieServiceProvider::class);
        $this->app->register(\Illuminate\Encryption\EncryptionServiceProvider::class);
        $this->app->register(\Illuminate\Validation\ValidationServiceProvider::class);
        $this->app->register(\Illuminate\Hashing\HashServiceProvider::class);
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
