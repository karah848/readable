<?php

class UserHandler
{
    public function create(): User
    {
        $this->createUser();
        $this->addDefaultPermissions();
        $this->sendWelcomeEmail();

        return $this->user;
    }
}
