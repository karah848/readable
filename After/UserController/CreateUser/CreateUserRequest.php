<?php

class CreateUserRequest implements CommandRequestInterface, QueryRequestInterface
{
    private $guard;
    private $userRepository;

    private $data;
    private $user;

    public function __construct(UserGuard $guard, UserRepository $userRepository)
    {
        $this->guard = $guard;
        $this->userRepository = $userRepository;
    }

    public function execute(): void
    {
        $this->validateData();
        $this->getSanitizedData();
        $this->createUser();
        $this->sendEmail();
    }

    public function get(): array
    {
        return $this->user->toArray();
    }

    private function validateData(): void
    {
        $this->guard->validate();
    }

    private function getSanitizedData(): void
    {
        $this->data = $this->guard->getSanitizedData();
    }

    private function createUser(): void
    {
        $creator = new UserCreator($this->userRepository, $this->data);
        $this->user = $creator->create();
    }

    private function sendEmail(): void
    {
        UserMailer::sendWelcome($this->user->email);
    }
}
