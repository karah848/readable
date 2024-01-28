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
        $request = new CreateUserRequest($data, $this->userRepository);
        $request->execute();
        $user = $request->get();
        return $user;
    }

    public function updateUser($data)
    {
        $request = new EditUserRequest($data, $this->userRepository);
        $request->execute();
        $user = $request->get();
        return $user;
    }
}
