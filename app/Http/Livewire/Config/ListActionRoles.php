<?php

namespace App\Http\Livewire\Config;

use App\Models\Action;
use App\Models\Role;
use App\Traits\TableSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ListActionRoles extends Component
{
    use WithPagination, TableSorting;

    public $valuesearch;

    protected $listeners = ['numofpage'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.config.list-action-roles', [
            'listRoles' => Role::dataOrder($this->valuesearch,
                $this->columsort, $this->indxorder)
                ->listRoles(null)
                ->withcount('actions')
                ->paginate($this->numpage),
            'countActions' => Action::count(),
        ])
            ->extends('layouts.app', ['title' => ''])
            ->section('workspace');
    }

    public function loadActionRoleInfo($idaccionrole, $actiquery)
    {
        $this->emit('closeModal');
        $this->emit('showActionRoleInfo', $idaccionrole, $actiquery);
    }
}
