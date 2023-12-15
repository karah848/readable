<?php

class EditUserRequest implements CommandRequestInterface, QueryRequestInterface
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
        $this->updateUser();
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

    private function updateUser(): void
    {
        $editor = new UserEditor($this->userRepository, $this->data);
        $this->user = $editor->edit();
    }
}
