<?php

namespace App\Classes\Registro\Principal;

use App\Models\Doctor;

class DoctorRecord
{
    public $originalDoctor
        = [
            'skill_id',
            'specialtie_id',
            'type_id',
            'state_id',
            'num_matricula',
            'interno_doc',
        ];

    public $originalUser
        = [
            'name',
            'lastname',
            'phone',
            'email',
        ];

    public function __construct(protected DoctorValidation $doctorValidation)
    {
    }

    public function doctorCreate($arraydoctordata)
    {

        $this->doctorValidation->ValidateCreateDoctor($arraydoctordata);

        $doc = Doctor::create(prepareData($arraydoctordata,
            $this->originalDoctor));
        $doc->user()->create(prepareData($arraydoctordata,
            $this->originalUser));

        return $doc;
    }

    public function doctorUpdate($arraydoctordata, $modelDoctor)
    {

        $this->doctorValidation->ValidateUpdateDoctor($arraydoctordata);
        //$doctor = $modelDoctor->update()
    }

    public function doctorShow($idDoctor)
    {
        return Doctor::doctorInfo($idDoctor);
    }
}
