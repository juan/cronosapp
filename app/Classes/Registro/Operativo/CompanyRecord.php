<?php

namespace App\Classes\Registro\Operativo;

use App\Models\Company;
use Illuminate\Support\Arr;

class CompanyRecord
{
    public $companyoriginaldata
        = [
            'city_id', 'company_name', 'company_cuit',
            'company_zipcode', 'company_phone', 'company_email',
            'company_web', 'company_address', 'company_zipcode',
            'company_person_contact', 'company_person_phone',
            'company_person_email',
        ];

    protected CompanyValidation $validation;

    public function __construct(CompanyValidation $validation)
    {
        $this->validation = $validation;
    }

    public function create($arraycompany)
    {
        $this->validation->ValidateCreate($arraycompany);
        $companyArray = $this->getcompanyAttributes($this->companyoriginaldata,
            $arraycompany);

        return Company::create($companyArray);
    }

    protected function getcompanyAttributes($arrayoriginal, $arrayrequest)
    {
        return Arr::only($arrayrequest, $arrayoriginal);
    }

    public function update($arraycompany, $id)
    {
        $company = Company::find($id);
        $this->validation->ValidateUpdate($arraycompany);
        $companyArray = $this->getcompanyAttributes($this->companyoriginaldata,
            $arraycompany);
        $company->update($companyArray);

        return $company;

    }

    public function show()
    {
        return Company::data();
    }
}
