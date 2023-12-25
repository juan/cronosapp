<?php

namespace Tests\Feature\Livewire\Principal;

use App\Http\Livewire\Principal\RegMedico;
use Livewire\Livewire;
use Tests\TestCase;

class RegMedicoTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(RegMedico::class);

        $component->assertStatus(200);
    }
}
