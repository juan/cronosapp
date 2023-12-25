<?php

namespace Tests\Feature\Livewire\Registro;

use App\Http\Livewire\Registro\Empresa;
use App\Models\Province;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class EmpresaTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $user = User::first();
        $this->actingAs($user);

        $this->get(route('re_empresa'))
            ->assertSuccessful()
            ->assertSeeLivewire(Empresa::class);
    }

    /** @test */
    public function see_if_all_property_are_wired()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(Empresa::class, ['user' => $user])
            ->assertPropertyWired('companydata.company_name')
            ->assertPropertyWired('companydata.company_cuit')
            ->assertPropertyWired('companydata.company_phone')
            ->assertPropertyWired('companydata.company_email')
            ->assertPropertyWired('companydata.company_web')
            ->assertPropertyWired('companydata.company_address')
            ->assertPropertyWired('companydata.company_zipcode')
            ->assertPropertyWired('companydata.company_person_contact')
            ->assertPropertyWired('companydata.company_person_phone')
            ->assertPropertyWired('companydata.company_person_email');

    }

    /** @test */
    public function check_buttons_save_and_cancel_are_present()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(Empresa::class, ['user' => $user])
            ->assertSee('Cancelar')
            ->assertSee('Guardar');
    }

    /** @test */
    public function check_provinces_can_load()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(Empresa::class, ['user' => $user])
            ->call('searchProvince');
        $this->assertTrue(Province::listProvince()->exists());
    }
}
