<?php

namespace App\Classes\Registro\Principal;

class UserRecord
{
    public function __construct(protected UserValidation $userValidation)
    {
    }

    public function userCreate($arrayuser)
    {
        $this->userValidation->ValidateCreateUser($arrayuser);
    }
}
