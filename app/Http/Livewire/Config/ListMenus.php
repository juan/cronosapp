<?php

namespace App\Http\Livewire\Config;

use App\Models\Role;
use App\Traits\TableSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ListMenus extends Component
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
        return view('livewire.config.list-menus', [
            'listRoles' => Role::dataOrder($this->valuesearch,
                $this->columsort, $this->indxorder)
                ->listRoles(null)
                ->withcount([
                    'menus' => function ($query) {
                        $query->whereNotNull('menus.menu_id')
                            ->whereNull('menus.titulo');
                    },
                ])
                ->paginate($this->numpage),
        ])
            ->extends('layouts.app', ['title' => ''])
            ->section('workspace');
    }

    public function loadMenuRoleInfo($idaccionrole, $actiquery)
    {
        $this->emit('closeModal');
        $this->emit('showMenuRoleInfo', $idaccionrole, $actiquery);
    }
}
