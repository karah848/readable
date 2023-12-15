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
        $guard = new UserGuard($data);
        $request = new CreateUserRequest($guard, $this->userRepository);
        $request->execute();
        $user = $request->get();
        return $user;
    }
}
