<?php

class CreateUserRequest implements CommandRequestInterface, QueryRequestInterface
{
    private $data;
    private $userRepository;

    private $guard;
    private $userData;
    private $user;

    public function __construct(array $data, UserRepository $userRepository)
    {
        $this->data = $data;
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
        $this->guard = new UserGuard($this->userData);
        $this->guard->validate();
    }

    private function getSanitizedData(): void
    {
        $this->userData = $this->guard->getSanitizedData();
    }

    private function createUser(): void
    {
        $creator = new UserCreator($this->userRepository, $this->userData);
        $this->user = $creator->create();
    }

    private function sendEmail(): void
    {
        UserMailer::sendWelcome($this->user->email);
    }
}
