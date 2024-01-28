<?php

class UserHandler
{
    private UserRepository $userRepository;
    private UserData $userData;

    private array $data;
    private string $permission;
    private bool $permissionValue;
    private User $user;

    public function __construct(UserRepository $userRepository, UserData $userData)
    {
        $this->userRepository = $userRepository;
        $this->userData = $userData;
    }

    public function create(): User
    {
        $this->createUser();
        $this->addDefaultPermissions();
        $this->sendWelcomeEmail();

        return $this->user;
    }
}
