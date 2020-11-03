<?php

namespace App\Events\Role;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\EventInterface;
use LaravelCode\EventSourcing\EventSourcing\StoreEvent;

class RoleDelete implements EventInterface
{
    use Dispatchable, InteractsWithSockets, SerializesModels, StoreEvent;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
