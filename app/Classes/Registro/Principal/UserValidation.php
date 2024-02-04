<?php

namespace App\Classes\Registro\Principal;

use App\Rules\ValidDate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserValidation
{
    public function ValidateCreateUser($arrayuser)
    {

        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayuser),

            [

                'name' => 'required|min:3|regex:/^([^<>]*)$/',
                'lastname' => 'required|min:3|regex:/^([^<>]*)$/',
                'dni' => [
                    'required', 'min:5',
                    Rule::unique('users')->where(function ($query) use (
                        $arrayuser
                    ) {
                        $query->where('identity_id',
                            $arrayuser['identity_id'])
                            ->where('dni',
                                $arrayuser['dni']);
                    }),
                ],
                'phone' => 'required|min_digits:5|regex:/^([^<>]*)$/|unique:users,phone',
                'datebirth' => [
                    'required', 'date_format:d/m/Y', 'regex:/^([^<>]*)$/',
                    new ValidDate('d/m/Y', $arrayuser['datebirth']),
                ],
                'email' => 'required|email:rfc,dns|regex:/^([^<>]*)$/|unique:users,email',
                'role_id' => 'required',
                'profile_photo_path' => 'sometimes|nullable|image|mimes:jpg,png,jpeg,svg|max:1500',
            ],

        )->validate();
    }

    public function inicialiciteAtributes($arrayuser)
    {
        return [
            'role_id' => str()->squish($arrayuser['role_id']),
            'state_id' => str()->squish($arrayuser['state_id']),
            'identity_id' => str()->squish($arrayuser['identity_id']),
            'gender_id' => str()->squish($arrayuser['gender_id']),
            'name' => str()->squish($arrayuser['name']),
            'lastname' => str()->squish($arrayuser['lastname']),
            'phone' => str()->squish($arrayuser['phone']),
            'email' => str()->lower(str()->squish($arrayuser['email'])),
            'dni' => str()->squish($arrayuser['dni']),
            'address' => str()->squish($arrayuser['address']),
            'datebirth' => $arrayuser['datebirth'],
            'profile_photo_path' => $arrayuser['profile_photo_path'],
        ];
    }

    public function generatePassword()
    {
        $length = 8;

        return substr(str_shuffle('0123456789ABCdefGHIJKLMNOPQRStuVWXYZ'), 1,
            $length);
    }

    public function ValidateUpdateUser($arrayuser)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayuser),

            [

                'name' => 'required|min:3|regex:/^([^<>]*)$/',
                'lastname' => 'required|min:3|regex:/^([^<>]*)$/',
                'dni' => [
                    'required', 'min:5',
                    Rule::unique('users')->where(function ($query) use (
                        $arrayuser
                    ) {
                        $query->where('identity_id',
                            $arrayuser['identity_id'])
                            ->where('id', '!=', $arrayuser['id'])
                            ->where('dni', $arrayuser['dni']);

                    }),
                ],
                'phone' => 'required|min_digits:5|regex:/^([^<>]*)$/',
                'datebirth' => [
                    'required', 'date_format:d/m/Y',
                    new ValidDate('d/m/Y', $arrayuser['datebirth']),
                ],
                'email' => 'required|email:rfc,dns|regex:/^([^<>]*)$/|unique:users,email,'
                    .$arrayuser['id'],
                'role_id' => 'required',

            ],

        )->validate();
    }
}
