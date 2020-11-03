<?php

namespace App\Listeners\User;

use App\Events;
use App\Events\Apply\User\UserRoleWasDeleted;
use App\Events\Apply\User\UserRoleWasUpdated;
use App\Models\User;
use LaravelCode\EventSourcing\Listeners\ApplyListener;

/**
 * Class UserRoleListener.
 *
 * @property User $entity
 */
class UserRoleListener
{
    use ApplyListener;

    /**
     * Set if the program is unable to guess the model class.
     */
    public $model = User::class;

    /**
     * Handle the event.
     *
     * @param Events\User\UserRole $event
     * @return void
     */
    public function handleCommand(Events\User\UserRole $event)
    {
        if (! $event->isRead() && ! $event->isWrite() && ! $event->isUpdate() && ! $event->isDelete()) {
            $this->event(new Events\Apply\User\UserRoleWasDeleted($event->getId(), $event->getRoleId()));

            return;
        }

        $this->event(new Events\Apply\User\UserRoleWasUpdated(
            $event->getId(),
            $event->getRoleId(),
            $event->isRead(),
            $event->isWrite(),
            $event->isUpdate(),
            $event->isDelete(),
        ));
    }

    public function applyUserRoleWasDeleted(UserRoleWasDeleted $event)
    {
        $this->entity->roles()->detach($event->getRoleId());
    }

    public function applyUserRoleWasUpdated(UserRoleWasUpdated $event)
    {
        $this->entity->roles()->syncWithoutDetaching([$event->getRoleId() => [
            'req_get' => $event->isRead(),
            'req_post' => $event->isWrite(),
            'req_put' => $event->isUpdate(),
            'req_delete' => $event->isDelete(),
        ]]);
    }
}
