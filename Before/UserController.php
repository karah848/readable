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

    public function updateUser($data)
    {
        $this->validateEmail($data["email"]);
        if (!isset($data["permissions"]) || empty($data["permissions"])) {
            throw new Exception("Permissions are required");
        }
        $handler = new UserHandler();
        $user = $handler->edit($this->userRepository, $data["id"], $data["email"], $data["fullname"], $data["permissions"]);
        return $user->toArray();
    }

    private function validateEmail()
    {
        // do stuff
    }
}
