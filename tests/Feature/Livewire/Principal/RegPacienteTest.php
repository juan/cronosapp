<?php

namespace Tests\Feature\Livewire\Principal;

use App\Http\Livewire\Principal\RegPaciente;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class RegPacienteTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(RegPaciente::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function component_can_load_data_patient()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(RegPaciente::class, ['user' => $user])
            ->call('render')
            ->assertViewHas('listGender')
            ->assertViewHas('ListIdentity')
            ->assertViewHas('ListTypeprestador');
    }

    /** @test */
    public function component_can_set_array_of_patient_values()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(RegPaciente::class, ['user' => $user])
            ->assertSet('datapaciente', [
                'identity_id' => '1', 'gender_id' => '',
                'name_patient' => '', 'lastname_patient' => '',
                'numberid_patient' => '', 'datebirth' => '',
                'cellphone' => '', 'email_patient' => '',
                'direccion_patient' => '', 'cuil_patient' => '',

            ]);
    }

    /** @test */
    public function component_can_set_array_of_table_insurance_values()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(RegPaciente::class, ['user' => $user])
            ->assertSet('insurancedata', [
                'insurance_type_id' => '',
                'insurance_id' => '',
                'insurance_plan_id' => '',
                'numafiliado' => '',
            ]);
    }

    /** @test */
    public function see_if_all_patient_property_are_wired()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(RegPaciente::class, ['user' => $user])
            ->assertPropertyWired('datapaciente.identity_id')
            ->assertPropertyWired('datapaciente.gender_id')
            ->assertPropertyWired('datapaciente.name_patient')
            ->assertPropertyWired('datapaciente.lastname_patient')
            ->assertPropertyWired('datapaciente.numberid_patient')
            ->assertPropertyWired('datapaciente.datebirth')
            ->assertPropertyWired('datapaciente.cellphone')
            ->assertPropertyWired('datapaciente.email_patient')
            ->assertPropertyWired('datapaciente.direccion_patient')
            ->assertPropertyWired('datapaciente.cuil_patient')
            ->assertPropertyWired('insurancedata.insurance_type_id')
            ->assertPropertyWired('insurancedata.insurance_id')
            ->assertPropertyWired('insurancedata.insurance_plan_id')
            ->assertPropertyWired('insurancedata.numafiliado');

    }
}
