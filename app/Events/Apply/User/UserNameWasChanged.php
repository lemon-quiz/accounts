<?php

namespace App\Events\Apply\User;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class UserNameWasChanged extends ApplyEvent implements ApplyEventInterface
{
    private string $name;

    public function __construct($id, $role_id)
    {
        parent::__construct($id);
        $this->name = $role_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id,
            $collection->get('name')
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}
