<?php


class HowAndWhat
{
    private $user;


    public function create(): User
    {
        $this->createUser();
        $this->addDefaultPermissions();
        $this->sendWelcomeEmail();

        return $this->user;
    }

    private function createUser()
    {
    }

    private function addDefaultPermissions()
    {
    }

    private function sendWelcomeEmail()
    {
    }
}

class HowAndWhat2
{
    private $user;
    private $email;


    public function create(): User
    {
        $this->createUser();
        $this->addDefaultPermissions();
        UserMailer::sendWelcome($this->email);

        return $this->user;
    }

    private function createUser()
    {
    }

    private function addDefaultPermissions()
    {
    }

    private function sendWelcomeEmail()
    {
    }
}
