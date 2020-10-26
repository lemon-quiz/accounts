<?php

namespace App\Events\User;

use Hash;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\EventInterface;
use LaravelCode\EventSourcing\EventSourcing\StoreEvent;

class UserUpdate implements EventInterface
{
    use Dispatchable, InteractsWithSockets, SerializesModels, StoreEvent;

    private string $name;
    private string $email;
    private array $roles = [];
    private ?string $password;

    /**
     * Create constructor.
     * @param $id
     * @param string $name
     * @param string $email
     * @param array $roles
     * @param string|null $password
     */
    public function __construct($id, string $name, string $email, array $roles = [], string $password = null)
    {
        $this->setId($id);
        $this->name = $name;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id,
            $collection->get('name'),
            $collection->get('email'),
            $collection->get('roles', []),
            $collection->has('password') ? Hash::make($collection->get('password')) : null,

        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'roles' => $this->getRoles(),
            'password' => $this->getPassword(),
        ];
    }
}
