<?php

namespace App\Classes\Registro\Operativo;

use App\Models\InsurancePlan;

class InsurancePlanRecord extends InsuranceRecord
{
    public $insuraplansOriginal
        = [
            'name_insplan', 'state_id',
            'insurance_id', 'descrip_insplan',
        ];

    protected InsurancePlanValidation $insurancePlanValidation;

    public function __construct(InsurancePlanValidation $insurancePlanValidation
    ) {
        $this->insurancePlanValidation = $insurancePlanValidation;
    }

    public function insuranceplanCreate($arrayInsurancePlan, $idInsurance)
    {
        $this->insurancePlanValidation->validateonCreate($arrayInsurancePlan,
            $idInsurance);
        $insuranPlans = InsurancePlan::create($arrayInsurancePlan);

        return $insuranPlans;
    }

    public function insuranceplanUpdate(
        $arrayInsurancePlan,
        $modelInsurancePlan
    ) {
        $this->insurancePlanValidation->validateonUpdate($arrayInsurancePlan);

        $modelInsurancePlan->update(prepareData($arrayInsurancePlan,
            $this->insuraplansOriginal));

        return $modelInsurancePlan;
    }
}
