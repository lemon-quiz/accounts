<?php

namespace App\Events\Apply\User;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class UserRoleWasDeleted extends ApplyEvent implements ApplyEventInterface
{
    private string $role_id;

    /**
     * UserRoleWasDeleted constructor.
     * @param $id
     * @param string $role_id
     */
    public function __construct($id, string $role_id)
    {
        parent::__construct($id);
        $this->role_id = $role_id;
    }

    /**
     * @return string
     */
    public function getRoleId(): string
    {
        return $this->role_id;
    }

    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id,
            $collection->get('role_id')
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'role_id' => $this->getRoleId(),
        ];
    }
}
