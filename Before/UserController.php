<?php

class UserController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($data)
    {
        $this->validateEmail($data["email"]);
        $handler = new UserHandler();
        $user = $handler->create($this->userRepository, $data["email"], $data["fullname"]);
        return $user->toArray();
    }

    private function validateEmail()
    {
    }
}
