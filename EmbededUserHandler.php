<?php


class UserHandler
{
    private UserRepository $userRepository;
    private string $email;
    private string $fullname;
    private array $permissions;

    private int $userId;
    private array $userData;
    private User $user;
    private string $permission;
    private bool $permissionValue;

    public function __construct(UserRepository $userRepository, string $email, string $fullname)
    {
        $this->userRepository = $userRepository;
        $this->email = $email;
        $this->fullname = $fullname;
    }

    public function create(): User
    {
        $this->createUser();
        $this->addDefaultPermissions();
        $this->sendWelcomeEmail();

        return $this->user;
    }

    public function edit(int $id, array $permissions): User
    {
        $this->userId = $id;
        $this->permissions = $permissions;

        $this->updateUser();
        $this->updatePermissions();

        return $this->user;
    }

    private function createUser()
    {
        $this->getUserData();
        $this->user = $this->userRepository->create($this->userData);
    }

    private function getUserData()
    {
        $this->userData = [
            'email' => $this->email,
            'fullname' => $this->fullname,
        ];
    }

    private function addDefaultPermissions()
    {
        $permissions = User::DEFAULT_PERMISSIONS;
        foreach ($permissions as $this->permission => $this->permissionValue) {
            $this->addUserPermission();
        }
    }

    private function addUserPermission()
    {
        $this->userRepository->addPermission($this->user->id, $this->permission, $this->permissionValue);
    }

    private function sendWelcomeEmail()
    {
        UserMailer::sendWelcome($this->email);
    }

    private function updateUser()
    {
        $this->getUserData();
        $this->user = $this->userRepository->get($this->userId);
        $this->user->update($this->userData);
    }

    private function updatePermissions()
    {
        array_unshift($permissions, USER::USER_ACCOUNT_PERMISSION);
        foreach ($this->permissions as $key => $val) {
            if ($key === User::ADMIN_PERMISSION) {
                continue;
            }
            $userPermission = $this->userRepository->getPermission($this->user->id, $key);
            if ($userPermission === null) {
                $this->userRepository->addPermission($this->user->id, $key, $val);
            } else {
                $this->userRepository->updatePermission($this->user->id, $key, $val);
            }
        }
    }
}
