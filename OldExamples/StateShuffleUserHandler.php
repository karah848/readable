<?php

class UserHandler
{
    public function create(UserRepository $userRepository, string $email, string $fullname): User
    {
        $user = $this->createUser($userRepository, $email, $fullname);
        $this->addDefaultPermissions($userRepository, $user);
        $this->sendWelcomeEmail($email);
        return $user;
    }

    private function createUser(UserRepository $userRepository, string $email, string $fullname): User

    private function getUserData(string $email, string $fullname)

    private function addDefaultPermissions(UserRepository $userRepository, User $user)

    private function sendWelcomeEmail($email)


    public function edit(UserRepository $userRepository, int $userId, string $email, string $fullname, array $permissions): User
    {
        $user = $this->updateUser($userRepository, $userId, $email, $fullname);
        $this->updatePermissions($userRepository, $user, $permissions);
        return $user;
    }

    private function createUser(UserRepository $userRepository, string $email, string $fullname): User
    {
        $data = $this->getUserData($email, $fullname);
        return $userRepository->create($data);
    }

    private function getUserData(string $email, string $fullname)
    {
        return [
            'email' => $email,
            'fullname' => $fullname,
        ];
    }

    private function addDefaultPermissions(UserRepository $userRepository, User $user)
    {
        $permissions = User::DEFAULT_PERMISSIONS;
        foreach ($permissions as $key => $val) {
            $this->addUserPermission($userRepository, $user, $key, $val);
        }
    }

    private function addUserPermission(UserRepository $userRepository, User $user, string $permission, bool $value)
    {
        $userRepository->addPermission($user->id, $permission, $value);
    }

    private function sendWelcomeEmail($email)
    {
        UserMailer::sendWelcome($email);
    }

    private function updateUser(UserRepository $userRepository, int $userId, string $email, string $fullname): User
    {
        $data = $this->getUserData($email, $fullname);
        $user = $userRepository->get($userId);
        $user->update($data);
        return $user;
    }

    private function updatePermissions(UserRepository $userRepository, User $user, array $permissions)
    {
        array_unshift($permissions, USER::USER_ACCOUNT_PERMISSION);
        foreach ($permissions as $key => $val) {
            if ($key === User::ADMIN_PERMISSION) {
                continue;
            }
            $userPermission = $userRepository->getPermission($user->id, $key);
            if ($userPermission === null) {
                $userRepository->addPermission($user->id, $key, $val);
            } else {
                $userRepository->updatePermission($user->id, $key, $val);
            }
        }
    }
}
