<?php

namespace App\Http\Livewire\Principal;

use App\Classes\Registro\Principal\DoctorRecord;
use App\Models\Skill;
use App\Models\Specialtie;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use Livewire\Component;

class RegMedico extends Component
{
    public $actiquery;

    public $isdisabled;

    public $lismedicos = [];

    public $datadoctor
        = [
            'skill_id' => '',
            'specialtie_id' => '',
            'type_id' => 1,
            'state_id' => 1,
            'num_matricula' => '',

        ];

    public $datauser
        = [
            'name_doc' => '',
            'lastname_doc' => '',
            'phone_doc' => '',
            'email_doc' => '',
        ];

    public $doctorobjet;

    public $useobjet;

    protected $listeners = ['loadDoctorInfo'];

    protected DoctorRecord $doctorrecord;

    public function boot(DoctorRecord $doctorrecord)
    {
        $this->doctorrecord = $doctorrecord;
    }

    public function render()
    {

        return view('livewire.principal.reg-medico',
            [
                'listSpecialities' => Specialtie::listSpeciality()->get(),
                'listSkills' => Skill::listSkill()->get(),
                'liststatus' => State::listStates([1, 2])->get(),
                'ListTypes' => Type::listTypes([1, 2])->get(),
            ])
            ->extends('layouts.app', ['title' => 'Médico'])
            ->section('workspace');
    }

    public function getDoctor()
    {
        empty($this->actiquery) ? $this->doctorCreate($this->datadoctor)
            : $this->doctorUpdate($this->datadoctor);
    }

    public function doctorCreate(array $arrayDoctor)
    {
        $doctor = $this->doctorrecord->doctorCreate($arrayDoctor,
            $this->useobjet);
        $this->emit(get_function_name(__FUNCTION__),
            $doctor->wasRecentlyCreated);
    }

    public function doctorUpdate(array $arrayDoctor)
    {

    }

    public function listDoctor()
    {

        $this->emit('openModal', ['moduloname' => 'principal.list-doctor']);
    }

    public function loadDoctorInfo($iddoctor, $opcionquery)
    {
        $docInfo = $this->doctorrecord->doctorShow($iddoctor);

        $this->actiquery = $opcionquery;

        $this->doctorobjet = $docInfo;

        $this->datadoctor = $docInfo->toArray();

        $opcionquery == 'view' ? $this->isdisabled = 'disabled'
            : $this->isdisabled = null;

    }

    public function cleanForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function findRoleMedic()
    {
        if (strlen($this->datauser['name_doc']) >= 2) {
            return $this->lismedicos = User::userbyRole(5,
                $this->datauser['name_doc'])
                ->get();

        } else {
            return $this->lismedicos = [];
        }
    }

    public function loadTempInfo(User $idUser)
    {
        $this->datauser['name_doc'] = $idUser->name;
        $this->datauser['lastname_doc'] = $idUser->lastname;
        $this->datauser['phone_doc'] = $idUser->phone;
        $this->datauser['email_doc'] = $idUser->email;
        $this->useobjet = $idUser;
    }

    public function limpiarListMedico()
    {
        $this->lismedicos = [];
        $this->datauser['name_doc'] = '';
    }
}
