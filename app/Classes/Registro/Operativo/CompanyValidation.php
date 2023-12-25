<?php

namespace App\Classes\Registro\Operativo;

use Illuminate\Support\Facades\Validator;

class CompanyValidation
{
    public function ValidateCreate($arraycompany)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arraycompany),

            [
                'company_name' => 'required|min:3|unique:companies,company_name|regex:/^([^<>]*)$/',
                'company_cuit' => 'required|min:6|unique:companies,company_cuit|regex:/^([^<>]*)$/',
                'company_phone' => 'required|min_digits:5|regex:/^([^<>]*)$/',
                'company_email' => 'required|email|unique:companies,company_email|regex:/^([^<>]*)$/',
                'province_id' => 'required',
                'city_id' => 'required',
                'company_address' => 'required|min:4|regex:/^([^<>]*)$/',
                'company_zipcode' => 'required|min:2|regex:/^([^<>]*)$/',
                'company_person_contact' => 'required|min:3|regex:/^([^<>]*)$/',
                'company_person_phone' => 'required|min_digits:5|regex:/^([^<>]*)$/',
                'company_person_email' => 'required|email|unique:companies,company_person_email|regex:/^([^<>]*)$/',
            ],

        )->validate();
    }

    public function inicialiciteAtributes($arraycompany)
    {
        return [
            'company_phone' => str()->squish($arraycompany['company_phone']),
            'company_email' => str()->lower(str()->squish($arraycompany['company_email'])),
            'province_id' => $arraycompany['province_id'],
            'city_id' => $arraycompany['city_id'],
            'company_address' => $arraycompany['company_address'],
            'company_zipcode' => $arraycompany['company_zipcode'],
            'company_person_contact' => str()->upper(str()->squish($arraycompany['company_person_contact'])),
            'company_person_phone' => str()->squish($arraycompany['company_person_phone']),
            'company_person_email' => str()->lower(str()->squish($arraycompany['company_person_email'])),
        ];
    }

    public function ValidateUpdate($arraycompany)
    {
        return $validatedData = Validator::make(
            $this->inicialiciteAtributes($arraycompany),

            [
                'company_phone' => 'required|min_digits:5|regex:/^([^<>]*)$/',
                'company_email' => 'required|regex:/^([^<>]*)$/|email|unique:companies,company_email,'
                    .$arraycompany['id'],
                'province_id' => 'required',
                'city_id' => 'required',
                'company_address' => 'required|min:4',
                'company_zipcode' => 'required|min:2|regex:/^([^<>]*)$/',
                'company_person_contact' => 'required|min:3|regex:/^([^<>]*)$/',
                'company_person_phone' => 'required|min_digits:5|regex:/^([^<>]*)$/',
                'company_person_email' => 'required|regex:/^([^<>]*)$/|email|unique:companies,company_person_email,'
                    .$arraycompany['id'],
            ],

        )->validate();
    }
}
