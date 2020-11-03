<?php

namespace App\Events\Apply\Role;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class RoleWasDeleted extends ApplyEvent implements ApplyEventInterface
{
}
