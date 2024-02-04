<?php

namespace App\Http\Livewire\Principal;

use App\Classes\Registro\Operativo\InsuranceRecord;
use App\Classes\Registro\Principal\PacienteRecord;
use App\Models\Gender;
use App\Models\Identity;
use App\Models\InsurancePlan;
use App\Models\InsuranceType;
use App\Traits\TableSorting;
use Illuminate\Support\Arr;
use Livewire\Component;

class RegPaciente extends Component
{
    use TableSorting;

    public $pacientObj;

    public $datapaciente
        = [
            'identity_id' => '1', 'gender_id' => '',
            'name_patient' => '', 'lastname_patient' => '',
            'numberid_patient' => '', 'datebirth' => '',
            'cellphone' => '', 'email_patient' => '',
            'direccion_patient' => '', 'cuil_patient' => '',
        ];

    public $insurancedata
        = [

            'insurance_type_id' => '',
            'insurance_id' => '',
            'insurance_plan_id' => '',
            'numafiliado' => '',
        ];

    public $tablaseguros;

    public $arrayinsurance = [];

    public $arrayplan = [];

    public $actiquery;

    public $isdisabled;

    public $arrayIndexTable;

    public $idInsuracPatien;

    protected $listeners = ['removeItemArray', 'showPatientInfo'];

    private PacienteRecord $pacienteRecord;

    private InsuranceRecord $insrancerecord;

    public function boot(
        PacienteRecord $pacienteRecord,
        InsuranceRecord $insrancerecord,

    ) {
        $this->pacienteRecord = $pacienteRecord;
        $this->insrancerecord = $insrancerecord;

    }

    public function getPaciente()
    {

        if (is_null($this->tablaseguros)) {
            $this->showmessage('informacion',
                'Se requiere información del paciente');

            return;
        }

        empty($this->actiquery) ? $this->patienteCreate($this->datapaciente)
            : $this->patienteUpdate($this->datapaciente);
    }

    public function showmessage($nameevent, $mesaage)
    {

        $this->dispatchBrowserEvent($nameevent,
            ['textresultado' => $mesaage]);
    }

    public function patienteCreate($arraypatiente)
    {

        $patiente = $this->pacienteRecord->pacienCreate($arraypatiente,
            $this->tablaseguros);

        $this->emit(get_function_name(__FUNCTION__),
            $patiente->wasRecentlyCreated);
    }

    public function patienteUpdate($arraypatiente)
    {

        $patiente = $this->pacienteRecord->pacienUpdate($this->pacientObj,
            $arraypatiente,
            $this->tablaseguros);

        $this->showPatientInfo($patiente->id, 'update');
    }

    public function showPatientInfo($idpatient, $acion)
    {

        if ($acion == 'view') {
            $this->isdisabled = 'disabled';
        } else {
            $this->isdisabled = '';
            $this->actiquery = 'update';
        }

        $this->resetArrayInsurance();

        $infoPatient = $this->pacienteRecord->pacientShow($idpatient);

        $this->pacientObj = $infoPatient;

        $this->datapaciente = $infoPatient->toArray();

        $this->loadTableInsurances($this->pacientObj);

    }

    public function resetArrayInsurance()
    {
        $this->reset('insurancedata', 'arrayinsurance', 'arrayplan',
            'idInsuracPatien');
    }

    public function loadTableInsurances($patientObj)
    {
        $arrayPateintInfo = [];
        foreach ($patientObj->insurance_patient as $datainsuran) {

            $arrayPateintInfo[] = [
                'typeprestador' => $datainsuran->insurance->insurance_type->name_type,
                'numafiliado' => $datainsuran->numafiliado,
                'nameinsurace' => $datainsuran->insurance->name_insurance,
                'nameplan' => $datainsuran->plan?->name_insplan,
                'insurance_type_id' => (string) $datainsuran->insurance->insurance_type->id,
                'insurance_id' => (string) $datainsuran->insurance->id,
                'insurance_plan_id' => (string) $datainsuran->plan?->id,
                'insurapatiendid' => (string) $datainsuran->id,
            ];
        }

        $this->tablaseguros = $arrayPateintInfo;
    }

    public function render()
    {
        return view('livewire.principal.reg-paciente',
            [
                'listGender' => Gender::all()->sortBy('id'),
                'ListIdentity' => Identity::all()->sortBy('id'),
                'ListTypeprestador' => InsuranceType::listTypeInsurance(null,
                    null)
                    ->get(),
            ])
            ->extends('layouts.app', ['title' => 'Paciente'])
            ->section('workspace');
    }

    public function loadInsurances()
    {

        $this->insrancerecord->validateInsurance($this->insurancedata);

        if ($this->checkArrayInsurance() == 1) {
            $this->resetArrayInsurance();
            $this->showmessage('informacion', 'Datos ya registrados');

            return;
        }

        $infoinsur
            = $this->insrancerecord->swhowInsurance($this->insurancedata['insurance_id']);

        $infoplan = ! empty($this->insurancedata['insurance_plan_id'])
            ? InsurancePlan::find($this->insurancedata['insurance_plan_id'])->name_insplan
            : null;

        $arrayinsudata
            = [
                'typeprestador' => $infoinsur->insurance_type->name_type,
                'nameinsurace' => $infoinsur->name_insurance,
                'nameplan' => $infoplan,
                'numafiliado' => $this->insurancedata['numafiliado'],

            ];

        $this->tablaseguros[] = Arr::collapse([
            $this->insurancedata, $arrayinsudata,
        ]);
        $this->resetArrayInsurance();
    }

    public function checkArrayInsurance()
    {
        $arraycomp = ['insurance_type_id', 'insurance_id', 'insurance_plan_id'];

        return check_arrays($this->insurancedata, $this->tablaseguros,
            $arraycomp);
    }

    public function removeItemArray($indexArray)
    {

        $this->tablaseguros = remove_array_item($this->tablaseguros,
            $indexArray);
        $this->showmessage('avisoResultado', 'Registro eliminado');

    }

    public function cleanForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->resetArrayInsurance();
    }

    public function confirmRemoveItem($indexArray)
    {
        $this->dispatchBrowserEvent('confirm', ['id' => $indexArray]);
    }

    public function listPatient()
    {
        $this->emit('openModal', ['moduloname' => 'principal.list-patient']);
    }

    public function updateInsurancePatient($idinsuraPatient)
    {

        $this->resetArrayInsurance();
        $this->idInsuracPatien = $idinsuraPatient;

        $datainsuracePatient
            = $this->pacienteRecord->patientInfoInsurance($idinsuraPatient);

        $this->insurancedata = [
            'insurance_type_id' => $datainsuracePatient->insurance->insurance_type_id,
            'insurance_id' => $datainsuracePatient->insurance->id,
            'insurance_plan_id' => $datainsuracePatient->insurance_plan_id,
            'numafiliado' => $datainsuracePatient->numafiliado,
        ];

        $this->getInsuranceTypeid();
        $this->getInsurancePlan();
    }

    public function getInsuranceTypeid()
    {

        $this->arrayinsurance
            = InsuranceType::find($this->insurancedata['insurance_type_id'])->insurances;

    }

    public function getInsurancePlan()
    {

        $this->arrayplan
            = $this->insrancerecord->swhowInsurance($this->insurancedata['insurance_id'])->insuranceplans;
    }

    public function insuracepatientUpdate()
    {

        $this->insrancerecord->validateInsurance($this->insurancedata);
        $patienInsura
            = $this->pacienteRecord->patienInsureaUpdate($this->insurancedata,
                $this->idInsuracPatien);

        $this->showPatientInfo($this->pacientObj->id, 'update');
        $this->emit(get_function_name(__FUNCTION__),
            $patienInsura->getChanges());

    }
}
