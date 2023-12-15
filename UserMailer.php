<?php

namespace ~\projects\read;

class UserMailer
{
    public static function sendWelcome(int $id): void
    {
        echo "Sending welcome email to user with id $id";
    }
}
