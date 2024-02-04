<?php

namespace App\Classes\Registro\Principal;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DoctorValidation
{
    public function ValidateCreateDoctor($arrayDoc)
    {

        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayDoc),

            [
                'skill_id' => 'required',
                'num_matricula' => [
                    'required', 'min:3',
                    Rule::unique('doctors')->where(function ($query) use (
                        $arrayDoc
                    ) {
                        $query->where('type_id',
                            $arrayDoc['type_id'])
                            ->where('num_matricula',
                                $arrayDoc['num_matricula']);
                    }),
                ],

                'specialtie_id' => ['required'],

            ],

        )->validate();
    }

    public function inicialiciteAtributes($arrayDoc)
    {
        return [
            'skill_id' => str()->squish($arrayDoc['skill_id']),
            'specialtie_id' => str()->squish($arrayDoc['specialtie_id']),
            'type_id' => str()->squish($arrayDoc['type_id']),
            'state_id' => str()->squish($arrayDoc['state_id']),
            'num_matricula' => str()->squish($arrayDoc['num_matricula']),

        ];
    }

    public function ValidateUpdateDoctor($arrayDoc)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayDoc),

            [
                'skill_id' => 'required',
                'num_matricula' => [
                    'required', 'min:3',
                    Rule::unique('doctors')->where(function ($query) use (
                        $arrayDoc
                    ) {
                        $query->where('type_id',
                            $arrayDoc['type_id'])
                            ->where('num_matricula',
                                $arrayDoc['num_matricula'])
                            ->where('id', '<>', $arrayDoc['id']);
                    }),
                ],
                'specialtie_id' => ['required'],

            ],

        )->validate();
    }
}
