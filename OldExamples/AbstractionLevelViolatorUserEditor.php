<?php

class UserEditor
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

    public function edit(): User
    {
        $this->updateUser();
        $this->updatePermissions();

        return $this->user;
    }

    private function updateUser()
    {
        $this->getData();
        $this->user = $this->userRepository->get($this->userData->id);
        $this->user->update($this->data);
    }

    private function getData()
    {
        $this->data = [
            'email' => $this->userData->email,
            'fullname' => $this->userData->fullname,
        ];
    }

    private function updatePermissions()
    {
        foreach ($this->permissions as $key) {
            $userPermission = $this->userRepository->getPermission($this->user->id, $key);
            if ($userPermission === null) {
                $this->userRepository->addPermission($this->user->id, $key);
            }
        }
    }
}
