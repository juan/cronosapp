<?php

namespace App\Http\Livewire\Registro;

use App\Classes\Registro\Operativo\InsurancePlanRecord;
use App\Classes\Registro\Operativo\InsuranceRecord;
use App\Models\Insurance;
use App\Models\InsuranceType;
use App\Models\State;
use App\Traits\TableSorting;
use Livewire\Component;
use Livewire\WithPagination;

class Obrasocial extends Component
{
    use TableSorting, WithPagination;

    public $obrasocial
        = [
            'insurance_type_id' => '', 'state_id' => 1,
            'name_insurance' => '', 'telefono' => '',
            'correo' => '',
        ];

    public $tipoprestador;

    public $componentName;

    public $nameinsurance = '';

    public $namestate = 'ACTIVO';

    public $openWindow = false;

    public $insuraceaccion;

    public $obrasocialmodel;

    protected $listeners = ['numofpage', 'reloadObra' => 'render'];

    private InsuranceRecord $insuranceRecord;

    private InsurancePlanRecord $insurancePlanRecord;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.registro.obrasocial',
            [
                'liststatus' => State::listStates([1, 2])->get(),
                'lisprestadores' => InsuranceType::listTypeInsurance()->get(),
                'listInsurance' => Insurance::dataOrder($this->nameinsurance,
                    $this->columsort, $this->indxorder)
                    ->tableQuery()
                    ->paginate($this->numpage),
            ])
            ->extends('layouts.app', ['title' => 'Prestadores'])
            ->section('workspace');
    }

    public function boot(
        InsuranceRecord $insuranceRecord,

    ) {
        $this->insuranceRecord = $insuranceRecord;

    }

    public function loadforEdit(Insurance $insurance)
    {
        $this->obrasocialmodel = $insurance;
        $this->obrasocial = $insurance->toArray();
        $this->tipoprestador = $insurance->insurance_type->name_type;
        $this->namestate = $insurance->state->state_name;
        $this->insuraceaccion = 'edit';
        $this->openWindow = true;
    }

    public function insuranceAccion()
    {
        empty($this->insuraceaccion) ? $this->insuranceCreate()
            : $this->insuranceUpdate();
    }

    protected function insuranceCreate()
    {
        $insurance = $this->insuranceRecord->create($this->obrasocial);
        $this->openWindow = false;
        $this->emit(get_function_name(__FUNCTION__),
            $insurance->wasRecentlyCreated);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    protected function insuranceUpdate()
    {
        $insurance = $this->insuranceRecord->update($this->obrasocial,
            $this->obrasocialmodel);
        $this->openWindow = false;
        $this->emit(get_function_name(__FUNCTION__),
            $insurance->getChanges());
        $insurance->fresh();
        $this->resetForm();
    }

    public function newInsurancePlan($idinsurance)
    {
        $this->emit('openModal',
            ['moduloname' => 'registro.insurances-plan', 'id' => $idinsurance]);
    }

    public function newTypePrestador()
    {
        $this->emit('openModal', ['moduloname' => 'registro.type-prestador']);
    }
}
