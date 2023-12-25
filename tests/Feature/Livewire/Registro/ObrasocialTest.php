<?php

namespace Tests\Feature\Livewire\Registro;

use App\Http\Livewire\Registro\Obrasocial;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class ObrasocialTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Obrasocial::class);

        $component->assertStatus(200);

    }

    /** @test */
    public function component_can_display_all_states_and_prestadores()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(Obrasocial::class, ['user' => $user])
            ->call('render')
            ->assertViewHas('liststatus')
            ->assertViewHas('lisprestadores')
            ->assertViewHas('listInsurance');
    }

    /** @test */
    public function component_can_set_array_of_values()
    {
        $user = User::first();
        $this->actingAs($user);
        Livewire::actingAs($user)
            ->test(Obrasocial::class, ['user' => $user])
            ->assertSet('obrasocial', [
                'insurance_type_id' => '', 'state_id' => 1,
                'name_insurance' => '', 'telefono' => '',
                'correo' => '',
            ]);
    }
}
