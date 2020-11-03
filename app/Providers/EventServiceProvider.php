<?php

namespace App\Providers;

use App\Listeners\Role\RoleCreateListener;
use App\Listeners\Role\RoleDeleteListener;
use App\Listeners\Role\RoleUpdateListener;
use App\Listeners\User\UserCreateListener;
use App\Listeners\User\UserDeleteListener;
use App\Listeners\User\UserRoleListener;
use App\Listeners\User\UserUpdateListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $subscribe = [
        UserCreateListener::class,
        UserUpdateListener::class,
        UserDeleteListener::class,
        UserRoleListener::class,

        RoleCreateListener::class,
        RoleUpdateListener::class,
        RoleDeleteListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
