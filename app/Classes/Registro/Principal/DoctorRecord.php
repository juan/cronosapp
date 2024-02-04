<?php

namespace App\Classes\Registro\Principal;

use App\Models\Doctor;

class DoctorRecord
{
    public function __construct(protected DoctorValidation $doctorValidation)
    {
    }

    public function doctorCreate($arraydoctordata, $userObj)
    {
        $this->doctorValidation->ValidateCreateDoctor($arraydoctordata);

        $doc = $userObj->doctor()->create($arraydoctordata);

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
