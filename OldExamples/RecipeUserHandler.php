<?php


class UserHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(): User
    {
        $this->createUser();
        $this->addDefaultPermissions();
        $this->sendWelcomeEmail();

        return $this->user;
    }

    private function sendWelcomeEmail()
    {
        UserMailer::sendWelcome($this->user->email);
    }


    public function edit(): User
    {
        $this->updateUser();
        $this->updatePermissions();

        return $this->user;
    }

    private function createUser(): void
    {
    }

    private function addDefaultPermissions()
    {
    }

    private function updateUser()
    {
    }

    private function updatePermissions()
    {
    }
}
