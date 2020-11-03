<?php

namespace App\Listeners\Role;

use App\Events\Apply\Role\RoleWasUpdated;
use App\Events\Role\RoleUpdate;
use App\Models\Role;
use LaravelCode\EventSourcing\Listeners\ApplyListener;

class RoleUpdateListener
{
    use ApplyListener;

    /**
     * Set if the program is unable to guess the model class.
     */
    public $model = Role::class;

    /**
     * Handle the event.
     *
     * @param RoleUpdate $event
     * @return void
     */
    public function handleCommand(RoleUpdate $event)
    {
        $this->event(new RoleWasUpdated(
            $event->getId(),
            $event->getName(),
            $event->getGrouped(),
            $event->isPrivate(),
            $event->isInitEmployee(),
        ));
    }

    /**
     * @param RoleWasUpdated $event
     */
    public function applyRoleWasUpdated(RoleWasUpdated $event)
    {
        $this->entity->name = $event->getName();
        $this->entity->grouped = $event->getGrouped();
        $this->entity->private = $event->isPrivate();
        $this->entity->init_employee = $event->isInitEmployee();
    }
}
