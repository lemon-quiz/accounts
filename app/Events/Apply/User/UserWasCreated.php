<?php

namespace App\Events\Apply\User;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class UserWasCreated extends ApplyEvent implements ApplyEventInterface
{
    private string $name;
    private string $password;
    private string $email;
    private array $roles = [];

    /**
     * Create constructor.
     * @param string $name
     * @param string $password
     * @param string $email
     * @param array $roles
     */
    public function __construct($id, string $name, string $password, string $email, array $roles = [])
    {
        parent::__construct($id);
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->roles = $roles;
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
    public function getPassword(): string
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
            $collection->get('password'),
            $collection->get('email'),
            $collection->get('roles', [])
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail(),
            'roles' => $this->getRoles(),
        ];
    }
}
