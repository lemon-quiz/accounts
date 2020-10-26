<?php

namespace App\Events\Apply\User;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class UserWasDeleted extends ApplyEvent implements ApplyEventInterface
{
    public function __construct($id)
    {
        parent::__construct($id);
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
