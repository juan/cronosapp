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
                'name' => 'required|min:3|regex:/^([^<>]*)$/',
                'lastname' => 'required|min:3|regex:/^([^<>]*)$/',
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
                'email' => [
                    'sometimes', 'email:rfc,dns', 'regex:/^([^<>]*)$/',
                    Rule::unique('users')->where(function ($query) {
                        $query->whereNotNull('email');
                    }),
                ],
                'specialtie_id' => [
                    Rule::requiredIf(function () use ($arrayDoc) {
                        if (! empty($arrayDoc['interno_doc'])) {

                            return true;

                        }
                    }),
                ],
                'phone' => [
                    'numeric', 'regex:/^([^<>]*)$/',
                    Rule::requiredIf(function () use ($arrayDoc) {
                        if (! empty($arrayDoc['interno_doc'])) {

                            return true;

                        }
                    }),
                ],

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
            'name' => str()->squish($arrayDoc['name']),
            'lastname' => str()->squish($arrayDoc['lastname']),
            'num_matricula' => str()->squish($arrayDoc['num_matricula']),
            'interno_doc' => str()->squish($arrayDoc['interno_doc']),
            'phone' => str()->squish($arrayDoc['phone']),
            'email' => str()->lower(str()->squish($arrayDoc['email'])),
        ];
    }

    public function ValidateUpdateDoctor($arrayDoc)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arrayDoc),

            [
                'skill_id' => 'required',
                'name' => 'required|min:3|regex:/^([^<>]*)$/',
                'lastname' => 'required|min:3|regex:/^([^<>]*)$/',
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
                'email' => [
                    'sometimes', 'email:rfc,dns', 'regex:/^([^<>]*)$/',
                    Rule::unique('users')->where(function ($query) use (
                        $arrayDoc
                    ) {
                        $query->whereNotNull('email')
                            ->where('id', '<>', $arrayDoc['id']);
                    }),
                ],
                'specialtie_id' => [
                    Rule::requiredIf(function () use ($arrayDoc) {
                        if (! empty($arrayDoc['interno_doc'])) {

                            return true;

                        }
                    }),
                ],
                'phone' => [
                    'numeric', 'regex:/^([^<>]*)$/',
                    Rule::requiredIf(function () use ($arrayDoc) {
                        if (! empty($arrayDoc['interno_doc'])) {

                            return true;

                        }
                    }),
                ],

            ],

        )->validate();
    }
}
