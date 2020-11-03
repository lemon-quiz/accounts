<?php

namespace App\Events\Role;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use LaravelCode\EventSourcing\Contracts\EventInterface;
use LaravelCode\EventSourcing\EventSourcing\StoreEvent;

class RoleCreate implements EventInterface
{
    use Dispatchable, InteractsWithSockets, SerializesModels, StoreEvent, RoleBaseEvent;

    private string $name;
    private string $grouped;
    private bool $private;
    private bool $initEmployee;
}
