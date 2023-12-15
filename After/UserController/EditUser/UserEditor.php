<?php

class UserEditor
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

    public function edit(): User
    {
        $this->updateUser();
        $this->updatePermissions();

        return $this->user;
    }

    private function updateUser()
    {
        $this->getUser();
        $this->updateUserData();
    }

    private function getUser()
    {
        $this->user = $this->userRepository->get($this->userData->id);
    }

    private function updateUserData()
    {
        $this->user->update([
            'email' => $this->userData->email,
            'fullname' => $this->userData->fullname,
        ]);
    }

    private function updatePermissions()
    {
        foreach ($this->permissions as $this->permission) {
            $this->addPermissionIfMissing();
        }
    }

    private function addPermissionIfMissing()
    {
        if ($this->userPermissionIsMissing()) {
            $this->addPermission();
        }
    }

    private function userPermissionIsMissing()
    {
        $userPermission = $this->userRepository->getPermission($this->user->id, $this->permission);
        return $userPermission == null;
    }

    private function addPermission()
    {
        $this->userRepository->addPermission($this->user->id, $this->permission);
    }
}
