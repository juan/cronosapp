<?php

namespace App\Classes\Registro\Principal;

use App\Classes\Utilidad\UserConfig;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Password;

class UserRecord
{
    use UploadFileTrait;

    protected UserValidation $userValidation;

    protected UserConfig $userConfig;

    public function __construct(
        UserValidation $userValidation,
        UserConfig $userConfig
    ) {
        $this->userValidation = $userValidation;
        $this->userConfig = $userConfig;
    }

    public function userCreate($arrayuser)
    {

        $this->userValidation->ValidateCreateUser($arrayuser);

        $arrayuser['password'] = $this->userValidation->generatePassword();

        $newuser = User::create($arrayuser);

        if ($newuser) {
            if (! empty($arrayuser['profile_photo_path'])) {
                $this->userUploadFile($arrayuser['profile_photo_path'],
                    $newuser);
            }

            /*Create User Role*/
            $this->userConfig->userRoleCreate($newuser);

            /*Send a Email */
            // Create a password reset token
            $token = Password::createToken($newuser);

            // Send password reset notification to user
            $newuser->sendPasswordResetNotification($token, 'fromuser');
        }

        return $newuser;
    }

    protected function userUploadFile($file, $userObj): void
    {
        if (gettype($file) != 'string') {
            $photoPath = $this->store_file($file,
                '/user/user_', $userObj->id);
            $userObj->update(['profile_photo_path' => $photoPath]);
        }
    }

    public function userUpdate($useroobject, $arrayuser)
    {
        $this->userValidation->ValidateUpdateUser($arrayuser);

        $useroobject->update(prepareData($arrayuser,
            User::getModelAttributes()));

        if (! empty($arrayuser['profile_photo_path'])) {
            $this->userUploadFile($arrayuser['profile_photo_path'],
                $useroobject);
        }

        return $useroobject;
    }
}
