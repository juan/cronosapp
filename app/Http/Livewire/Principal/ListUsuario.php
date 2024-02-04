<?php

namespace App\Http\Livewire\Principal;

use App\Models\User;
use App\Traits\TableSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsuario extends Component
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
        return view('livewire.principal.list-usuario', [
            'listUsers' => User::dataOrder($this->valuesearch,
                $this->columsort, $this->indxorder)
                ->tableQuery()
                ->paginate($this->numpage),
            'opcionSort' => User::arraycolumSor(),
        ])
            ->extends('layouts.app', ['title' => ''])
            ->section('workspace');
    }

    public function loadUserInfo($iduser, $opcionload)
    {
        $this->emit('closeModal');
        $this->emit('showUserInfo', $iduser, $opcionload);
    }
}
