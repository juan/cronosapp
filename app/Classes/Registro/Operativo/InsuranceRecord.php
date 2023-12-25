<?php

namespace App\Classes\Registro\Operativo;

use App\Models\Insurance;

class InsuranceRecord
{
    public $obrasocialOriginal
        = [
            'insurance_type_id', 'state_id',
            'name_insurance', 'telefono',
            'correo',
        ];

    protected InsuranceValidation $insuranceValidation;

    public function __construct(InsuranceValidation $insuranceValidation)
    {
        $this->insuranceValidation = $insuranceValidation;
    }

    public function create($arrayInsurance)
    {
        $this->insuranceValidation->ValidateCreated($arrayInsurance);

        return Insurance::create($arrayInsurance);
    }

    public function update($arrayInsurance, $insurancemodel)
    {
        $this->insuranceValidation->ValidateUpdate($arrayInsurance);
        $insurancemodel->update(prepareData($arrayInsurance,
            $this->obrasocialOriginal));

        return $insurancemodel;
    }

    public function swhowInsurance($idInsurace)
    {
        return Insurance::with('insurance_type')->find($idInsurace);
    }

    public function validateInsurance($arrayInsurances)
    {

        return $this->insuranceValidation->validateInsurancesPatien($arrayInsurances);
    }
}
