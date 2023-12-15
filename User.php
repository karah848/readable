<?php


class User
{
    public const DEFAULT_PERMISSIONS = [];
    public const ADMIN_PERMISSION = 'admin';
    public const USER_ACCOUNT_PERMISSION = 'my_account';

    public int $id;
    public string $email;

    public function update(): void
    {
    }

    public function toArray(): array
    {
        return [];
    }
}
