<?php

namespace App\Classes\Registro\Principal;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PacienteValidation
{
    public function ValidateCreatePatient($arraypatient)
    {

        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arraypatient),

            [
                'name_patient' => 'required|min:3|regex:/^([^<>]*)$/',
                'lastname_patient' => 'required|min:3|regex:/^([^<>]*)$/',
                'numberid_patient' => [
                    'required', 'min:5',
                    Rule::unique('patients')->where(function ($query) use (
                        $arraypatient
                    ) {
                        $query->where('identity_id',
                            $arraypatient['identity_id'])
                            ->where('numberid_patient',
                                $arraypatient['numberid_patient']);
                    }),
                ],
                'cellphone' => 'required|min_digits:5|regex:/^([^<>]*)$/',
                'datebirth' => 'required|date_format:d/m/Y|regex:/^([^<>]*)$/',
                'direccion_patient' => 'sometimes|min:5|regex:/^([^<>]*)$/',
                'cuil_patient' => [
                    'sometimes', 'min:5', 'regex:/^([^<>]*)$/',
                    Rule::unique('patients')->where(function ($query) {
                        $query->whereNotNull('cuil_patient');
                    }),
                ],
                'email_patient' => [
                    'sometimes', 'email:rfc,dns', 'regex:/^([^<>]*)$/',
                    Rule::unique('patients')->where(function ($query) {
                        $query->whereNotNull('email_patient');
                    }),
                ],
            ],

        )->validate();
    }

    public function inicialiciteAtributes($arraypatient)
    {
        return [
            'name_patient' => str()->squish($arraypatient['name_patient']),
            'lastname_patient' => str()->squish($arraypatient['lastname_patient']),
            'numberid_patient' => str()->squish($arraypatient['numberid_patient']),
            'datebirth' => date('d/m/Y', strtotime($arraypatient['datebirth'])),
            'cellphone' => str()->squish($arraypatient['cellphone']),
            'email_patient' => str()->lower(str()->squish($arraypatient['email_patient'])),
            'direccion_patient' => str()->squish($arraypatient['direccion_patient']),
            'cuil_patient' => str()->squish($arraypatient['cuil_patient']),
        ];
    }

    public function ValidateUpdatePatient($arraypatient)
    {

        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arraypatient),

            [
                'name_patient' => 'required|min:3|regex:/^([^<>]*)$/',
                'lastname_patient' => 'required|min:3|regex:/^([^<>]*)$/',
                'numberid_patient' => [
                    'required', 'min:5',
                    Rule::unique('patients')->where(function ($query) use (
                        $arraypatient
                    ) {
                        $query->where('identity_id',
                            $arraypatient['identity_id'])
                            ->where('id', '<>', $arraypatient['id'])
                            ->where('numberid_patient',
                                $arraypatient['numberid_patient']);
                    }),
                ],
                'cellphone' => 'required|min_digits:5|regex:/^([^<>]*)$/',
                'datebirth' => 'required|date_format:d/m/Y|regex:/^([^<>]*)$/',
                'direccion_patient' => 'sometimes|min:5|regex:/^([^<>]*)$/',
                'cuil_patient' => [
                    'sometimes', 'min:5', 'regex:/^([^<>]*)$/',
                    Rule::unique('patients')->where(function ($query) use (
                        $arraypatient
                    ) {
                        $query->whereNotNull('cuil_patient')
                            ->where('id', '<>', $arraypatient['id']);
                    }),
                ],
                'email_patient' => [
                    'sometimes', 'email:rfc,dns', 'regex:/^([^<>]*)$/',
                    Rule::unique('patients')->where(function ($query) use (
                        $arraypatient
                    ) {
                        $query->whereNotNull('email_patient')
                            ->where('id', '<>', $arraypatient['id']);
                    }),
                ],
            ],

        )->validate();
    }
}
