<?php

namespace App\Listeners\Role;

use App\Events\Apply\Role\RoleWasDeleted;
use App\Events\Role\RoleDelete;
use App\Models\Role;
use LaravelCode\EventSourcing\Listeners\ApplyListener;

class RoleDeleteListener
{
    use ApplyListener;

    /**
     * Set if the program is unable to guess the model class.
     */
    public string $model = Role::class;

    /**
     * Handle the event.
     *
     * @param RoleDelete $event
     * @return void
     */
    public function handleCommand(RoleDelete $event)
    {
        $this->event(new RoleWasDeleted($event->getId()));
    }

    /**
     * @param RoleWasDeleted $event
     */
    public function applyRoleWasDeleted(RoleWasDeleted $event)
    {
        $this->delete();
    }
}
