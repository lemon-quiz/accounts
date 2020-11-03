<?php

namespace App\Listeners\Role;

use App\Events;
use App\Events\Apply\Role\RoleWasCreated;
use App\Models\Role;
use LaravelCode\EventSourcing\Listeners\ApplyListener;

class RoleCreateListener
{
    use ApplyListener;

    /**
     * Set if the program is unable to guess the model class.
     */
    public $model = Role::class;

    /**
     * Handle the event.
     *
     * @param Events\Role\RoleCreate $event
     * @return void
     */
    public function handleCommand(Events\Role\RoleCreate $event)
    {
        $this->event(new RoleWasCreated(
            null,
            $event->getName(),
            $event->getGrouped(),
            $event->isPrivate(),
            $event->isInitEmployee(),
        ));
    }

    /**
     * @param RoleWasCreated $event
     */
    public function applyRoleWasCreated(RoleWasCreated $event)
    {
        $this->entity->name = $event->getName();
        $this->entity->grouped = $event->getGrouped();
        $this->entity->private = $event->isPrivate();
        $this->entity->init_employee = $event->isInitEmployee();
    }
}
