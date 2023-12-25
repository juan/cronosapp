<?php

namespace App\Http\Livewire\Principal;

use App\Classes\Registro\Principal\UserRecord;
use App\Models\Gender;
use App\Models\Identity;
use App\Models\Role;
use App\Models\State;
use Livewire\Component;

class RegUsuario extends Component
{
    public $datauser
        = [
            'role_id' => '',
            'state_id' => 1,
            'identity_id' => 1,
            'gender_id' => 1,
            'name' => '',
            'lastname' => '',
            'email' => '',
            'dni' => '',
            'address' => '',
            'phone' => '',
            'password' => '',
            'datebirth' => '',
            'profile_photo_path' => '',
        ];

    protected UserRecord $userRecord;

    public function render()
    {
        return view('livewire.principal.reg-usuario', [
            'listGender' => Gender::all()->sortBy('id'),
            'ListIdentity' => Identity::all()->sortBy('id'),
            'liststatus' => State::listStates([1, 2])->get(),
            'listRoles' => Role::listRoles([2, 3, 4, 5, 6])->get(),
        ])
            ->extends('layouts.app', ['title' => 'Usuario'])
            ->section('workspace');
    }

    public function boot(UserRecord $userRecord)
    {
        $this->userRecord = $userRecord;
    }

    public function getUsuario()
    {
        $this->userRecord->userCreate($this->datauser);
    }
}
