<?php

namespace App\Classes\Registro\Operativo;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InsurancePlanValidation
{
    public function validateonCreate($arrayInsuraPlans, $idInsurance)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayInsuraPlans),

            [
                'name_insplan' => [
                    'required',
                    'min:3',
                    'regex:/^([^<>]*)$/',
                    Rule::unique('insurance_plans')->where(function ($query) use (
                        $idInsurance,
                        $arrayInsuraPlans

                    ) {
                        $query->where('insurance_id', $idInsurance)
                            ->where('name_insplan',
                                str()->upper($arrayInsuraPlans['name_insplan']));
                    }),
                ],
                'state_id' => 'required|exists:states,id',
                'insurance_id' => 'required|exists:insurances,id',
                'descrip_insplan' => 'sometimes|regex:/^([^<>]*)$/',
            ],

        )->validate();
    }

    public function inicialiciteAtributes($arrayInsuraPlans)
    {
        return [
            'name_insplan' => str()->upper(str()->squish($arrayInsuraPlans['name_insplan'])),
            'state_id' => str()->squish($arrayInsuraPlans['state_id']),
            'insurance_id' => str()->squish($arrayInsuraPlans['insurance_id']),
            'descrip_insplan' => str()->upper(str()->squish($arrayInsuraPlans['descrip_insplan'])),
        ];
    }

    public function validateonUpdate(
        $arrayInsuraPlans,

    ) {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayInsuraPlans),

            [
                'name_insplan' => [
                    'required',
                    'min:3',
                    'regex:/^([^<>]*)$/',
                    Rule::unique('insurance_plans')->where(function ($query) use (
                        $arrayInsuraPlans
                    ) {

                        $query->where('id', '<>', $arrayInsuraPlans['id'])
                            ->where('name_insplan',
                                str()->upper($arrayInsuraPlans['name_insplan']))
                            ->where('insurance_id',
                                $arrayInsuraPlans['insurance_id']);

                    }),
                ],
                'state_id' => 'required|exists:states,id',
                'insurance_id' => 'required|exists:insurances,id',
                'descrip_insplan' => 'sometimes|regex:/^([^<>]*)$/',
            ],

        )->validate();
    }
}
