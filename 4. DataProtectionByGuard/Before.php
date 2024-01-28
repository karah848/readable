<<?php

    class UserController
    {
        public function createUser($data)
        {
            $this->validateEmail($data["email"]);
            // ...
        }
    }

    class UserHandler
    {
        private function handlePermissions(UserRepository $userRepository, User $user, array $permissions)
        {
            $this->ignoreAdminPermission($data);
            // ...
        }
    }

    class UserRepository
    {
        public function create(array $data): User
        {
            $this->validateRequiredFields($data);
            // ...
        }
    }





