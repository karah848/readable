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
}
