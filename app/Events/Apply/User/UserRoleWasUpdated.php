<?php

namespace App\Events\Apply\User;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class UserRoleWasUpdated extends ApplyEvent implements ApplyEventInterface
{
    private string $role_id;
    private bool $read;
    private bool $write;
    private bool $update;
    private bool $delete;

    /**
     * UserRoleWasDeleted constructor.
     * @param $id
     * @param string $role_id
     * @param bool $read
     * @param bool $write
     * @param bool $update
     * @param bool $delete
     */
    public function __construct($id, string $role_id, bool $read, bool $write, bool $update, bool $delete)
    {
        parent::__construct($id);
        $this->role_id = $role_id;
        $this->read = $read;
        $this->write = $write;
        $this->update = $update;
        $this->delete = $delete;
    }

    /**
     * @return string
     */
    public function getRoleId(): string
    {
        return $this->role_id;
    }

    /**
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->read;
    }

    /**
     * @return bool
     */
    public function isWrite(): bool
    {
        return $this->write;
    }

    /**
     * @return bool
     */
    public function isUpdate(): bool
    {
        return $this->update;
    }

    /**
     * @return bool
     */
    public function isDelete(): bool
    {
        return $this->delete;
    }


    public static function fromPayload($id, Collection $collection)
    {
        return new self(
            $id,
            $collection->get('role_id'),
            $collection->get('read'),
            $collection->get('write'),
            $collection->get('update'),
            $collection->get('delete')
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->getId(),
            'role_id' => $this->getRoleId(),
            'read' => $this->isRead(),
            'write' => $this->isWrite(),
            'update' => $this->isUpdate(),
            'delete' => $this->isDelete(),
        ];
    }
}
