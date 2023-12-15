<?php

class UserRepository
{
    public function create(array $data): User
    {
        // database stuff
        return new User();
    }

    public function update(int $userId, array $data): void
    {
    }

    public function get(int $userId): User
    {
        return new User();
    }

    public function getPermission(int $userId, string $permission): ?string
    {
        return null;
    }

    public function addPermission(int $userId, string $permission): void
    {
    }

    public function updatePermission(int $userId, string $permission, bool $value): void
    {
    }
}
