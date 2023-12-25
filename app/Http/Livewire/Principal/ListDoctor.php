<?php

namespace App\Http\Livewire\Principal;

use App\Models\Doctor;
use App\Traits\TableSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ListDoctor extends Component
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
        return view('livewire.principal.list-doctor', [
            'listDoctors' => Doctor::dataOrder($this->valuesearch,
                $this->columsort, $this->indxorder)
                ->searchTerm($this->valuesearch, $this->columsort)
                ->with(['skill', 'state', 'type', 'specialtie'])
                ->paginate($this->numpage),
            'opcionSort' => Doctor::arraycolumSor(),
        ])
            ->extends('layouts.app', ['title' => ''])
            ->section('workspace');
    }

    public function loadDoctorInfo($iddoctor, $opcionquery)
    {
        $this->emit('closeModal');
        $this->emit('loadDoctorInfo', $iddoctor, $opcionquery);

    }
}
