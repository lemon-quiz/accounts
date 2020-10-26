<?php

namespace App\Events\Apply\User;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class UserPasswordWasChanged extends ApplyEvent implements ApplyEventInterface
{
    private ?string $password;

    public function __construct($id, $password)
    {
        parent::__construct($id);
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id,
            $collection->get('password')
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'password' => $this->getPassword(),
        ];
    }
}
