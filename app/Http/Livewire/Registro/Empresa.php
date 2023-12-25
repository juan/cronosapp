<?php

namespace App\Http\Livewire\Registro;

use App\Classes\Registro\Operativo\CompanyRecord;
use App\Models\City;
use App\Models\Company;
use App\Models\Province;
use Livewire\Component;

class Empresa extends Component
{
    public $provincearray;

    public $provincisearch;

    public $cityarray;

    public $citysearch;

    public $companycase;

    public $existe;

    public $companydata
        = [
            'province_id' => '', 'city_id' => '', 'state_id' => 1,
            'company_name' => '',
            'company_cuit' => '', 'company_address' => '',
            'company_zipcode' => '',
            'company_phone' => '', 'company_email' => '', 'company_web' => '',
            'company_person_contact' => '', 'company_person_phone' => '',
            'company_person_email' => '',
        ];

    private CompanyRecord $companyRecord;

    public function mount()
    {

        $this->countCompany() > 0 ?
            $this->clonData($this->companyRecord->show())
            : null;
    }

    protected function countCompany()
    {
        return Company::count('id');
    }

    protected function clonData($datacompany)
    {
        $this->companydata = $datacompany->toArray();
        $this->provincisearch
            = $this->companydata['city']['province']['province_name'];
        $this->companydata['province_id']
            = $this->companydata['city']['province']['id'];
        $this->citysearch = $this->companydata['city']['city_name'];
    }

    public function searchCity()
    {
        return $this->cityarray
            = $this->companydata['province_id'] > 0
            ? City::listCity($this->citysearch,
                $this->companydata['province_id'])->get() : null;
    }

    public function render()
    {

        $this->existe = $this->countCompany();

        $this->countCompany() > 0 ?
            $this->clonData($this->companyRecord->show())
            : null;

        return view('livewire.registro.empresa')
            ->extends('layouts.app', ['title' => 'Empresa'])
            ->section('workspace');
    }

    public function boot(CompanyRecord $companyRecord)
    {
        $this->companyRecord = $companyRecord;
    }

    public function getEmpresavalue()
    {

        $this->countCompany() == 0 ? $this->companyCreate($this->companydata)
            : $this->companyUpdate();

    }

    protected function companyCreate($companyarray)
    {

        $comanydb = $this->companyRecord->create($companyarray);
        $funcioname = get_function_name(__FUNCTION__);

    }

    protected function companyUpdate()
    {

        $comanydb = $this->companyRecord->update($this->companydata,
            $this->companydata['id']);
        $this->emit(get_function_name(__FUNCTION__), $comanydb->getChanges());

    }

    public function searchProvince()
    {

        $this->provincearray = Province::listProvince($this->provincisearch)
            ->get();
    }

    public function cleanForm()
    {
        $this->countCompany() == 0 ? $this->reset()
            : $this->clonData($this->companyRecord->show());
        $this->resetValidation();
        $this->resetErrorBag();
    }
}
