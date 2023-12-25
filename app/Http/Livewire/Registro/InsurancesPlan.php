<?php

namespace App\Http\Livewire\Registro;

use App\Classes\Registro\Operativo\InsurancePlanRecord;
use App\Models\Insurance;
use App\Models\InsurancePlan;
use App\Models\State;
use App\Traits\TableSorting;
use Livewire\Component;

class InsurancesPlan extends Component
{
    use TableSorting;

    public $idmodel;

    public $accionform;

    public $namestate;

    public $insuraplans
        = [
            'name_insplan' => '', 'state_id' => 1,
            'insurance_id' => '', 'descrip_insplan' => '',
        ];

    public $modelinsurance;

    public $objinsurnaceplan;

    protected $listeners = ['numofpage'];

    private InsurancePlanRecord $insurancePlanRecord;

    public function boot(InsurancePlanRecord $insurancePlanRecord)
    {
        $this->insurancePlanRecord = $insurancePlanRecord;
    }

    public function mount(Insurance $idmodel)
    {
        $this->modelinsurance = $idmodel;
        $this->namestate = 'ACTIVO';
        $this->insuraplans['insurance_id'] = $this->modelinsurance->id;
    }

    public function render()
    {
        return view('livewire.registro.insurances-plan', [
            'liststatus' => State::listStates([1, 2])->get(),
            'listInsurancePlans' => InsurancePlan::dataOrder('',
                $this->columsort, $this->indxorder)
                ->tableQuery($this->modelinsurance->id)
                ->paginate($this->numpage),
        ])
            ->extends('layouts.app', ['title' => ''])
            ->section('workspace');
    }

    public function getDataInsuranPlan()
    {
        empty($this->accionform)
            ? $this->insuranceplansCreate($this->insuraplans)
            : $this->insuranceplansUpdate();
    }

    protected function insuranceplansCreate($arrayInsuranceplan)
    {
        $insplancreate
            = $this->insurancePlanRecord->insuranceplanCreate($arrayInsuranceplan,
                $this->modelinsurance->id);
        $this->emit(get_function_name(__FUNCTION__),
            $insplancreate->wasRecentlyCreated);
        //$this->emit('reloadObra');
        $this->js('$wire.$parent.$refresh()');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset('insuraplans');
        $this->resetValidation();
        $this->resetErrorBag();
    }

    protected function insuranceplansUpdate()
    {

        $insuranPlan
            = $this->insurancePlanRecord->insuranceplanUpdate($this->insuraplans,
                $this->objinsurnaceplan);

        $this->emit(get_function_name(__FUNCTION__),
            $insuranPlan->getChanges());
    }

    public function loadforEdit(InsurancePlan $insurancePlan)
    {
        $this->objinsurnaceplan = $insurancePlan;
        $this->accionform = 'edit';
        $this->namestate = $insurancePlan->state->state_name;
        $this->insuraplans = $insurancePlan->toArray();
    }
}
