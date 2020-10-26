<?php

namespace App\Listeners\User;


use App\Events\Apply\User\UserEmailWasChanged;
use App\Events\Apply\User\UserNameWasChanged;
use App\Events\Apply\User\UserPasswordWasChanged;
use App\Events\User\UserUpdate;
use App\Models\User;
use LaravelCode\EventSourcing\Listeners\ApplyListener;

class UserUpdateListener
{
    use ApplyListener;

    /**
     * Set if the program is unable to guess the model class
     */
    public string $model = User::class;

    public function handleCommand(UserUpdate $event)
    {

        if ($this->entity->name !== $event->getName()) {
            $this->event(new UserNameWasChanged($this->entity->id, $event->getName()));
        }
        if ($this->entity->email !== $event->getEmail()) {
            $this->event(new UserEmailWasChanged($this->entity->id, $event->getEmail()));
        }
        if (null !== $event->getPassword()) {
            $this->event(new UserPasswordWasChanged($this->entity->id, $event->getPassword()));
        }
    }

    public function applyUserNameWasChanged(UserNameWasChanged $event)
    {
        $this->entity->name = $event->getName();
    }

    public function applyUserEmailWasChanged(UserEmailWasChanged $event)
    {
        $this->entity->email = $event->getEmail();
    }

    public function applyUserPasswordWasChanged(UserPasswordWasChanged $event)
    {
        $this->entity->password = $event->getPassword();
    }
}
