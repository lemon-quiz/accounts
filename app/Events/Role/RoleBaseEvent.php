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
use phpDocumentor\Reflection\Types\Boolean;

trait RoleBaseEvent
{
    /**
     * RoleCreate constructor.
     * @param $id
     * @param string $name
     * @param string $grouped
     * @param bool $private
     * @param bool $initEmployee
     */
    public function __construct($id, string $name, string $grouped, bool $private, bool $initEmployee)
    {
        $this->id = $id;
        $this->name = $name;
        $this->grouped = $grouped;
        $this->private = $private;
        $this->initEmployee = $initEmployee;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGrouped(): string
    {
        return $this->grouped;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->private;
    }

    /**
     * @return bool
     */
    public function isInitEmployee(): bool
    {
        return $this->initEmployee;
    }
    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id,
            $collection->get('name'),
            $collection->get('grouped'),
            $collection->get('private', false),
            $collection->get('init_employee', false),
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'grouped' => $this->getName(),
            'private' => $this->isPrivate(),
            'init_employee' => $this->isInitEmployee(),
        ];
    }
}
