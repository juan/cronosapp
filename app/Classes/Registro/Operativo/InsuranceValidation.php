<?php

namespace App\Classes\Registro\Operativo;

use App\Models\Insurance;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InsuranceValidation
{
    public function ValidateCreated($arrayInsurance)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayInsurance),

            [
                'name_insurance' => 'required|min:3|unique:insurances,name_insurance|regex:/^([^<>]*)$/',
                'state_id' => 'required|exists:states,id',
                'insurance_type_id' => 'required|exists:insurance_types,id',
                'telefono' => 'sometimes|numeric|regex:/^([^<>]*)$/',
                'correo' => 'sometimes|email|unique:insurances,correo|regex:/^([^<>]*)$/',
            ],

        )->validate();
    }

    public function inicialiciteAtributes($arrayInsurance)
    {
        return [
            'insurance_type_id' => str()->squish($arrayInsurance['insurance_type_id']),
            'state_id' => str()->squish($arrayInsurance['state_id']),
            'name_insurance' => str()->upper(str()->squish($arrayInsurance['name_insurance'])),
            'telefono' => str()->lower(str()->squish($arrayInsurance['telefono'])),
            'correo' => str()->lower(str()->squish($arrayInsurance['correo'])),
        ];
    }

    public function ValidateUpdate($arrayInsurance)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayInsurance),

            [
                'name_insurance' => 'required|min:3|regex:/^([^<>]*)$/|unique:insurances,name_insurance,'
                    .$arrayInsurance['id'],
                'state_id' => 'required|exists:states,id',
                'insurance_type_id' => 'required|exists:insurance_types,id',
                'telefono' => 'sometimes|numeric|regex:/^([^<>]*)$/',
                'correo' => 'sometimes|email|regex:/^([^<>]*)$/|unique:insurances,correo,'
                    .$arrayInsurance['id'],
            ],

        )->validate();
    }

    public function validateInsurancesPatien($arrayInsurances)
    {

        return $validatedData = Validator::make(

            $this->inicialiciteInsurancePatientAtribures($arrayInsurances),

            [
                'insurance_type_id' => 'required|regex:/^([^<>]*)$/',
                'insurance_id' => 'required|regex:/^([^<>]*)$/',
                'insurance_plan_id' => [
                    Rule::requiredIf(function () use ($arrayInsurances) {
                        if (! empty($arrayInsurances['insurance_id'])) {
                            $countInplans
                                = Insurance::find($arrayInsurances['insurance_id'])->insuranceplans->count()
                                > 0;
                            if ($countInplans > 0
                                and empty($arrayInsurances['insurance_plan_id'])
                            ) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }),
                ],
            ],

        )->validate();
    }

    public function inicialiciteInsurancePatientAtribures($arrayInsurances)
    {
        return [
            'insurance_type_id' => str()->squish($arrayInsurances['insurance_type_id']),
            'insurance_id' => str()->squish($arrayInsurances['insurance_id']),
            'numafiliado' => str()->squish($arrayInsurances['numafiliado']),
            'plan_id' => str()->squish($arrayInsurances['insurance_plan_id']),
        ];
    }
}
