<?php

namespace App\Classes\Utilidad;

use App\Models\Role;

class UserConfig
{
    public function __construct(
        protected UserConfigValidation $userconfigvalidation
    ) {
    }

    public function actionroleCreate($arrayactionrole)
    {
        $this->userconfigvalidation->ValidateCreateActionRole($arrayactionrole);

        $rolaction = $this->findRole($arrayactionrole['role_id']);

        $rolaction->actions()->detach();

        $rolaction->actions()->toggle($arrayactionrole['action_id']);

        return $rolaction?->countCreate();
    }

    public function findRole($idRole)
    {
        return Role::find($idRole);
    }

    public function RoleInfo($idRole)
    {
        $rolaction = $this->findRole($idRole);

        return $rolaction->actions();
    }

    public function RoleMenuInfo($idRole)
    {
        $rolaction = $this->findRole($idRole);

        return $rolaction->menus();
    }

    public function validMenus($arraymenus)
    {
        $this->userconfigvalidation->ValidateCreateMenus($arraymenus);
    }

    public function menusCreate($arraymenus, $rolevalue, $strinarraymenu)
    {

        $role = $this->findRole($rolevalue);

        $role->menus()->detach();

        $role->menus()->attach($arraymenus,
            ['menu_option' => serialize($strinarraymenu)]);

    }
}
