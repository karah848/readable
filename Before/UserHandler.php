<?php

class UserHandler
{
    public function create(UserRepository $userRepository, string $email, string $fullname): User
    {
        $data = $this->getUserData($email, $fullname);
        $user = $userRepository->create($data);
        $permissions = User::DEFAULT_PERMISSIONS;
        $this->handlePermissions($userRepository, $user, $permissions);
        UserMailer::sendWelcome($email);
        return $user;
    }

    public function edit(UserRepository $userRepository, int $userId, string $email, string $fullname, array $permissions): User
    {
        $data = $this->getUserData($email, $fullname);
        $user = $userRepository->get($userId);
        $user->update($data);
        $this->handlePermissions($userRepository, $user, $permissions);
        return $user;
    }

    private function getUserData(string $email, string $fullname)
    {
        return [
            'email' => $email,
            'fullname' => $fullname,
        ];
    }

    private function handlePermissions(UserRepository $userRepository, User $user, array $permissions)
    {
        array_unshift($permissions, USER::USER_ACCOUNT_PERMISSION);
        foreach ($permissions as $key) {
            if ($key === User::ADMIN_PERMISSION) {
                continue;
            }
            $userPermission = $userRepository->getPermission($user->id, $key);
            if ($userPermission === null) {
                $userRepository->addPermission($user->id, $key);
            }
        }
    }
}
