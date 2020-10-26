<?php

namespace App\Events\Apply\User;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class UserEmailWasChanged extends ApplyEvent implements ApplyEventInterface
{
    private string $email;

    public function __construct($id, $email)
    {
        parent::__construct($id);
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id,
            $collection->get('email')
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
        ];
    }
}
