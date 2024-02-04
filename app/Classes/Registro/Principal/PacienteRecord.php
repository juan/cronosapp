<?php

namespace App\Classes\Registro\Principal;

use App\Events\Patient\NewEmailPatient;
use App\Models\InsurancePatient;
use App\Models\Patient;
use Illuminate\Support\Arr;

class PacienteRecord
{
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

        $newPatient = Patient::create($arraypatient);

        $newPatient->insurance_patient()->createMany($insurancplans);

        if (! empty($arraypatient['email_patient'])) {
            event(new NewEmailPatient($newPatient));
        }

        return $newPatient;
    }

    public function pacienUpdate($patienObj, $newdataPatien, $insuracetables)
    {

        $this->pacienteValidation->ValidateUpdatePatient($newdataPatien);

        $patienObj->update(prepareData($newdataPatien,
            Patient::getModelAttributes()));

        foreach ($insuracetables as $key => $datainsuratable) {

            $datainsuratable['insurance_plan_id']
                = empty($datainsuratable['insurance_plan_id']) ? null
                : $datainsuratable['insurance_plan_id'];

            $arrayforUpdate = prepareData($datainsuratable,
                InsurancePatient::getModelAttributes());

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
            InsurancePatient::getModelAttributes()));

        return $patientInsurance;
    }
}
