<?php

class UserCreator
{
    private UserRepository $userRepository;
    private UserData $userData;

    private array $permissions;
    private string $permission;
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

    private function createUser()
    {
        $this->user = $this->userRepository->create([
            'email' => $this->userData->email,
            'fullname' => $this->userData->fullname,
        ]);
    }

    private function addDefaultPermissions()
    {
        $this->setDefaultPermissions();
        $this->addPermissions();
    }

    private function setDefaultPermissions()
    {
        $this->permissions = User::DEFAULT_PERMISSIONS;
    }

    private function addPermissions()
    {
        foreach ($this->permissions as $this->permission) {
            $this->addPermission();
        }
    }

    private function addPermission()
    {
        $this->userRepository->addPermission($this->user->id, $this->permission);
    }

    private function sendWelcomeEmail()
    {
        UserMailer::sendWelcome($this->userData->email);
    }
}
