<?php

namespace App\Http\Livewire\Config;

use App\Models\Role;
use App\Models\State;
use App\Traits\TableSorting;
use Arr;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ConfRoles extends Component
{
    use TableSorting, WithPagination;

    public $roleinfo = ['name_role' => '', 'state_id' => 1];

    public $roleobj;

    public $namerole = '';

    public $namestate = 'ACTIVO';

    public $roleaction = '';

    public $openWindow = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.config.conf-roles', [
            'listRoles' => Role::dataOrder($this->namerole,
                $this->columsort, $this->indxorder)
                ->tableQuery()
                ->paginate($this->numpage),
            'liststatus' => State::listStates([1, 2])->get(),

        ])
            ->extends('layouts.app', ['title' => 'Permisos'])
            ->section('workspace');
    }

    public function loadforEdit($role)
    {
        $this->setRoleInfo($role);
        $roleinfo = $this->getRoleInfo();
        $this->roleinfo = $roleinfo->toArray();
        $this->namestate = $roleinfo->state->state_name;
        $this->roleaction = 'edit';
        $this->openWindow = true;
    }

    public function getRoleInfo()
    {
        return $this->roleobj;
    }

    public function setRoleInfo($role)
    {
        $this->roleobj = Role::find($role);

    }

    public function rolesAccion()
    {
        empty($this->roleaction) ? $this->roleCreate() : $this->roleUpdate();
    }

    public function roleCreate()
    {
        $validaterole = $this->validateRole($this->roleinfo);
        $role = Role::create($validaterole);
        $this->emit(get_function_name(__FUNCTION__),
            $role->wasRecentlyCreated);
        $this->resetForm();
    }

    public function validateRole($arrayrole)
    {

        if (empty($this->roleaction)) {
            return $validatedData = Validator::make(
                $this->iniAtributes($arrayrole),

                [
                    'name_role' => 'required|regex:/^([^<>]*)$/|unique:roles,name_role',
                ])->validate();
        } else {
            return $validatedData = Validator::make(
                $this->iniAtributes($arrayrole),

                [
                    'name_role' => 'required|regex:/^([^<>]*)$/|unique:roles,name_role,'
                        .$arrayrole['id'],
                ])->validate();
        }
    }

    public function iniAtributes($arrayrole)
    {

        return [
            'name_role' => str()->squish(str()->upper($arrayrole['name_role'])),
        ];
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function roleUpdate()
    {

        $this->validateRole($this->roleinfo);
        $this->getRoleInfo()->update(Arr::only($this->roleinfo,
            ['name_role', 'state_id']));
        $this->emit(get_function_name(__FUNCTION__),
            $this->getRoleInfo()->getChanges());
        $this->resetForm();
    }
}
