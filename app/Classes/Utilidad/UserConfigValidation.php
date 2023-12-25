<?php

namespace App\Classes\Utilidad;

use Illuminate\Support\Facades\Validator;

class UserConfigValidation
{
    public function ValidateCreateActionRole($arrayactionrole)
    {

        return $validatedData = Validator::make(

            $this->inicialiciteAtributesActionRole($arrayactionrole),

            [
                'role_id' => 'required',
                'action_id' => 'required',
            ],

        )->validate();
    }

    public function inicialiciteAtributesActionRole($arrayactionrole)
    {
        return [
            'role_id' => str()->squish($arrayactionrole['role_id']),
            'action_id' => str()->squish($arrayactionrole['action_id']),

        ];
    }

    public function ValidateCreateMenus($arraymenus)
    {
        return $validatedData = Validator::make(

            $this->inicialiciteAtributesMenus($arraymenus),

            [
                'role_id' => 'required',
                'menu_id' => 'required',
            ],

        )->validate();
    }

    public function inicialiciteAtributesMenus($arraymenus)
    {
        return [
            'role_id' => str()->squish($arraymenus['role_id']),
            'menu_id' => str()->squish($arraymenus['menu_id']),
        ];
    }
}
