<?php

namespace App\Listeners\User;

use App\Events;
use App\Events\Apply\User\UserWasCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use LaravelCode\EventSourcing\Contracts\EventInterface;
use LaravelCode\EventSourcing\Listeners\ApplyListener;

/**
 * Class Create
 * @package App\Listeners\User
 * @property User $entity
 */
class UserCreateListener
{
    use ApplyListener;

    /**
     * Set if the program is unable to guess the model class
     */
    public string $model = User::class;

    /**
     * Handle the event.
     *
     * @param Events\User\UserCreate $event
     * @return void
     */
    public function handleCommand(Events\User\UserCreate $event)
    {
        $this->event(new UserWasCreated(
            null,
            $event->getName(),
            $event->getPassword(),
            $event->getEmail(),
            $event->getRoles()
        ));
    }

    /**
     * @param UserWasCreated $event
     */
    public function applyUserWasCreated(UserWasCreated $event)
    {
        $this->entity->name = $event->getName();
        $this->entity->password = $event->getPassword();
        $this->entity->email = $event->getEmail();
    }
}
