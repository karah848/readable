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
}
