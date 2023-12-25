<?php

namespace Tests\Feature\Livewire\Registro;

use App\Http\Livewire\Registro\InsurancesPlan;
use Livewire\Livewire;
use Tests\TestCase;

class InsurancePlanTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(InsurancesPlan::class);

        $component->assertStatus(200);
    }
}
