<?php

namespace App\Http\Livewire\Principal;

use App\Models\Patient;
use App\Traits\TableSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ListPatient extends Component
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

        return view('livewire.principal.list-patient',
            [
                'listPatient' => Patient::dataOrder($this->valuesearch,
                    $this->columsort, $this->indxorder)
                    ->tableQuery()
                    ->paginate($this->numpage),
                'opcionSort' => Patient::arraycolumSor(),
            ])
            ->extends('layouts.app', ['title' => ''])
            ->section('workspace');
    }

    public function loadPatientInfo($idpatien, $opcionload)
    {
        $this->emit('closeModal');
        $this->emit('showPatientInfo', $idpatien, $opcionload);
    }
}
