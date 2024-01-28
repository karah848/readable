<<?php

    class UserController
    {
        // ...
        public function createUser($data)
        {
            $this->validateEmail($data["email"]);
            $handler = new UserHandler();
            $user = $handler->create($this->userRepository, $data["email"], $data["fullname"]);
            return $user->toArray();
        }
        // ...
    }

    class UserHandler
    {
        // ...
        private function handlePermissions(UserRepository $userRepository, User $user, array $permissions)
        {
            array_unshift($permissions, USER::USER_ACCOUNT_PERMISSION);
            foreach ($permissions as $key => $val) {
                if ($key === User::ADMIN_PERMISSION) {
                    continue;
                }
                // ...
            }
        }
    }

    class UserRepository
    {
        public function create(array $data): User
        {
            $this->validateRequiredFields($data);
            // ...
        }
        // ...
    }
