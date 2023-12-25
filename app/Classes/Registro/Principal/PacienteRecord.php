<?php

namespace App\Classes\Registro\Principal;

use App\Models\InsurancePatient;
use App\Models\Patient;
use Illuminate\Support\Arr;

class PacienteRecord
{
    public $originalPaciente
        = [
            'identity_id', 'gender_id',
            'name_patient', 'lastname_patient',
            'numberid_patient', 'datebirth',
            'cellphone', 'email_patient',
            'direccion_patient', 'cuil_patient',
        ];

    public $originalInsuracesPatien
        = [
            'insurance_id',
            'insurance_plan_id',
            'numafiliado',
        ];

    public function __construct(
        private PacienteValidation $pacienteValidation
    ) {

    }

    public function pacienCreate($arraypatient, $arrayinsurances)
    {

        for ($i = 0; $i < count($arrayinsurances); $i++) {

            $insurancplans[] = Arr::only($arrayinsurances[$i],
                [
                    'insurance_id', 'insurance_plan_id', 'numafiliado',
                ]);
        }

        $this->pacienteValidation->ValidateCreatePatient($arraypatient);

        $pacien = Patient::create(prepareData($arraypatient,
            $this->originalPaciente));

        $pacien->insurance_patient()->createMany($insurancplans);

        return $pacien;
    }

    public function pacienUpdate($patienObj, $newdataPatien, $insuracetables)
    {

        $this->pacienteValidation->ValidateUpdatePatient($newdataPatien);

        $patienObj->update(prepareData($newdataPatien,
            $this->originalPaciente));

        foreach ($insuracetables as $key => $datainsuratable) {

            $datainsuratable['insurance_plan_id']
                = empty($datainsuratable['insurance_plan_id']) ? null
                : $datainsuratable['insurance_plan_id'];

            $arrayforUpdate = prepareData($datainsuratable,
                $this->originalInsuracesPatien);

            $uniquesvalues = array_merge([
                'patient_id' => $patienObj->id,
            ], $arrayforUpdate);

            $cambios = InsurancePatient::updateOrCreate($uniquesvalues,
                $arrayforUpdate);

        }

        return $patienObj;
    }

    public function pacientShow($idPatient)
    {

        return Patient::with('insurance_patient.insurance',
            'insurance_patient.plan')
            ->find($idPatient);
    }

    public function patientInfoInsurance($idpatientinsurance)
    {
        return InsurancePatient::with('insurance')->find($idpatientinsurance);
    }

    public function patienInsureaUpdate($arrayInusraceData, $idInsuraPatient)
    {

        $patientInsurance
            = InsurancePatient::find($idInsuraPatient);

        $patientInsurance->update(prepareData($arrayInusraceData,
            $this->originalInsuracesPatien));

        return $patientInsurance;
    }
}
