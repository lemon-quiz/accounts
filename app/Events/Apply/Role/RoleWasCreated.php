<?php

namespace App\Events\Apply\Role;

use Illuminate\Support\Collection;
use LaravelCode\EventSourcing\Contracts\ApplyEventInterface;
use LaravelCode\EventSourcing\Event\Apply\ApplyEvent;

class RoleWasCreated extends ApplyEvent implements ApplyEventInterface
{
    private string $name;
    private string $grouped;
    private bool $private;
    private bool $initEmployee;

    /**
     * RoleCreate constructor.
     * @param $id
     * @param string $role_id
     * @param string $grouped
     * @param bool $private
     * @param bool $initEmployee
     */
    public function __construct($id, string $role_id, string $grouped, bool $private, bool $initEmployee)
    {
        parent::__construct($id);
        $this->id = $id;
        $this->name = $role_id;
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
            'grouped' => $this->getGrouped(),
            'private' => $this->isPrivate(),
            'init_employee' => $this->isInitEmployee(),
        ];
    }
}
