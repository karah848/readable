<?php

class UserGuard implements ValidatorInterface, SanitizerInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate(): void
    {
        // do stuff and throw exception if invalid
        // check required fields
        // check email format
        // ...
    }

    public function getSanitizedData()
    {
        // return sanitized data
        // add USER_ACCOUNT_PERMISSION
        // remove ADMIN_PERMISSION
        // ...
    }
}
