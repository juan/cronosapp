<?php

namespace App\Http\Livewire\Registro;

use App\Models\InsuranceType;
use App\Traits\TableSorting;
use Arr;
use Livewire\Component;
use Livewire\WithPagination;

class TypePrestador extends Component
{
    use WithPagination, TableSorting;

    public $name_type;

    public $typeprestador;

    public $typrestadorobj;

    public $lineamodificar;

    protected $rules
        = [
            'name_type' => 'required|regex:/^([^<>]*)$/|unique:insurance_types,name_type',
        ];

    public function render()
    {
        return view('livewire.registro.type-prestador', [
            'listTypePrestado' => InsuranceType::dataOrder($this->name_type,
                $this->columsort, $this->indxorder)
                ->paginate($this->numpage),
        ])
            ->extends('layouts.app', ['title' => ''])
            ->section('workspace');
    }

    public function typeprestadorCreate()
    {
        $this->name_speciality = str()->upper($this->name_type);
        $validatedData = $this->validate();
        $typeinsurance = InsuranceType::create($validatedData);
        $this->emit(get_function_name(__FUNCTION__),
            $typeinsurance->wasRecentlyCreated);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name_type = '';
        $this->resetErrorBag();
    }

    public function loadTypeInsuranceEdit(
        InsuranceType $insuranceType,
        $apuntador
    ) {
        $this->typrestadorobj = $insuranceType;
        $this->lineamodificar = $apuntador;
        $this->typeprestador['name_type'] = $insuranceType->name_type;
    }

    public function forCancelEdi()
    {
        $this->lineamodificar = 0;
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function typeinsuranceUpdate()
    {
        $this->typeprestador['name_type']
            = str()->upper($this->typeprestador['name_type']);
        $validatedData = $this->validate([
            'typeprestador.name_type' => 'required|regex:/^([^<>]*)$/|unique:insurance_types,name_type,'
                .$this->typrestadorobj->id,
        ]);

        $this->typrestadorobj->update(Arr::only($validatedData['typeprestador'],
            ['name_type']));
        $this->emit(get_function_name(__FUNCTION__),
            $this->typrestadorobj->getChanges());
        $this->typrestadorobj->fresh();
        $this->lineamodificar = 0;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
