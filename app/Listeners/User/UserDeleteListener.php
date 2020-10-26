<?php

namespace App\Listeners\User;

use App\Events;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use LaravelCode\EventSourcing\Contracts\EventInterface;
use LaravelCode\EventSourcing\Listeners\ApplyListener;

class UserDeleteListener
{
    use ApplyListener;

    /**
     * Set if the program is unable to guess the model class.
     */
    public $model = User::class;

    public function handleCommand(Events\User\UserDelete $event)
    {
        $this->event(new Events\Apply\User\UserWasDeleted($event->getId()));
    }

    public function applyUserWasDeleted(Events\Apply\User\UserWasDeleted $event)
    {
        $this->delete();
    }
}
