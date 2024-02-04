<?php

namespace App\Http\Livewire\Principal;

use App\Classes\Registro\Principal\UserRecord;
use App\Models\Gender;
use App\Models\Identity;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Livewire\Component;

class RegUsuario extends Component
{
    use UploadFileTrait;

    public $useraction;

    public $userobject;

    public $isdisabled;

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

    protected $listeners = ['showUserInfo'];

    private UserRecord $userRecord;

    public function boot(UserRecord $userRecord)
    {
        $this->userRecord = $userRecord;
    }

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

    public function getUsuario()
    {
        empty($this->useraction) ? $this->userCreate() : $this->userUpdate();

    }

    public function userCreate()
    {

        $newuser = $this->userRecord->userCreate($this->datauser);

        $this->emit(get_function_name(__FUNCTION__),
            $newuser->wasRecentlyCreated);

        $this->cleanForm();
    }

    public function cleanForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function userUpdate()
    {
        $edituser = $this->userRecord->userUpdate($this->userobject,
            $this->datauser);

        $this->emit(get_function_name(__FUNCTION__),
            $edituser->getChanges());

        $this->datauser = $this->userobject->refresh()->toArray();

    }

    public function updatedDatauserprofilephotopath()
    {
        $this->validate([
            'datauser.profile_photo_path' => 'sometimes|nullable|image|mimes:jpg,png,jpeg,svg|max:1500',
        ]);

    }

    public function listUser()
    {
        $this->emit('openModal', ['moduloname' => 'principal.list-usuario']);
    }

    public function showUserInfo($iduser, $acion)
    {
        if ($acion == 'view') {
            $this->isdisabled = 'disabled';
        } else {
            $this->isdisabled = '';
            $this->useraction = 'update';
        }
        $this->loadUserInfo($iduser);
    }

    public function loadUserInfo($iduser)
    {
        $this->namefoto = null;

        $this->userobject = User::find($iduser);

        $this->datauser = $this->userobject->toArray();

        $this->namefoto = ! empty($this->datauser['profile_photo_path'])
            ? $this->datauser['profile_photo_path'] : null;

        $this->reloadPhoto();
    }
}
