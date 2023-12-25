<?php

namespace App\Http\Livewire\Config;

use App\Models\Action;
use App\Models\Role;
use Livewire\Component;

class ConfPermisos extends Component
{
    public $actiquery;

    public $isdisabled;

    public $arrayactionrole
        = [
            'role_id' => '',
            'action_id' => [],
        ];

    protected $listeners = ['showActionRoleInfo'];

    public function render()
    {
        return view('livewire.config.conf-permisos', [
            'listRoles' => Role::listRoles(null, null)->get(),
            'listAccion' => Action::listActions()->get(),
        ])
            ->extends('layouts.app', ['title' => 'Permisos'])
            ->section('workspace');
    }

    public function getPermisos()
    {
        empty($this->actiquery)
            ? $this->actionroleCreate($this->arrayactionrole)
            :
            $this->actionroleUpdate($this->arrayactionrole);
    }

    public function actionroleCreate($arrayactionrole)
    {
        $rolaction = app('userconfig')->actionroleCreate($arrayactionrole);

        $this->emit(get_function_name(__FUNCTION__),
            $rolaction);
    }

    public function actionroleUpdate($arrayactionrole)
    {
        $this->actionroleCreate($this->arrayactionrole);
        $this->isdisabled = 'disabled';
    }

    public function listPermisos()
    {
        $this->emit('openModal', ['moduloname' => 'config.list-action-roles']);
    }

    public function showActionRoleInfo($idactionrole, $actiquery)
    {
        $this->actiquery = $actiquery;
        $actiquery == 'view' ? $this->isdisabled = 'disabled'
            : $this->isdisabled = null;
        $this->arrayactionrole = [
            'role_id' => $idactionrole,
            'action_id' => app('userconfig')->RoleInfo($idactionrole)->get()
                ->pluck('id'),
        ];
    }

    public function cleanForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
}
