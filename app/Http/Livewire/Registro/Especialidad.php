<?php

namespace App\Http\Livewire\Registro;

use App\Models\Specialtie;
use App\Models\State;
use App\Traits\TableSorting;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class Especialidad extends Component
{
    use WithPagination, TableSorting;

    public $name_speciality = '';

    public $id_status;

    public $states;

    public $specialties;

    // public $sateid;

    public $updateline = 0;

    public $namespeciality;

    public $specialityobj;

    protected $listeners = ['numofpage'];

    protected $rules
        = [
            'name_speciality' => 'required|regex:/^([^<>]*)$/|unique:specialties,name_speciality',
        ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.registro.especialidad',
            [
                'especialidades' => Specialtie::dataOrder($this->name_speciality,
                    $this->columsort, $this->indxorder)
                    ->tableQuery()
                    ->paginate($this->numpage),
            ])
            ->extends('layouts.app', ['title' => 'Especialidades'])
            ->section('workspace');
    }

    public function especialityCreate()
    {
        $this->name_speciality = str()->upper($this->name_speciality);
        $validatedData = $this->validate();
        $speciality = Specialtie::create($validatedData);
        $this->emit(get_function_name(__FUNCTION__),
            $speciality->wasRecentlyCreated);
        $this->name_speciality = '';

    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function forUpdateEspecialidad(Specialtie $specialtie, $nlinea)
    {
        $this->specialityobj = $specialtie;
        $this->states = State::listStates([1, 2])->get();
        $this->specialties['state_id'] = $this->specialityobj->state_id;
        $this->specialties['name_speciality']
            = $this->specialityobj->name_speciality;
        $this->updateline = $nlinea;
    }

    public function especialidadUpdate()
    {

        $this->specialties['name_speciality']
            = str()->upper($this->specialties['name_speciality']);
        $validatedData = $this->validate([
            'specialties.name_speciality' => 'required|regex:/^([^<>]*)$/|unique:specialties,name_speciality,'
                .$this->specialityobj->id,
            'specialties.state_id' => 'sometimes',
        ]);

        $this->specialityobj->update(Arr::only($validatedData['specialties'],
            ['name_speciality', 'state_id']));
        $this->emit(get_function_name(__FUNCTION__),
            $this->specialityobj->getChanges());
        $this->specialityobj->fresh();
        $this->updateline = 0;
    }

    public function forDeleteEspecialidad($id)
    {
        dd('wacho');
    }

    public function forCancelEdi()
    {
        $this->updateline = 0;
        $this->specialityobj = '';
        $this->resetValidation();
        $this->resetErrorBag();
    }
}
