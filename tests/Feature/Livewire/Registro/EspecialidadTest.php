<?php

namespace Tests\Feature\Livewire\Registro;

use App\Http\Livewire\Registro\Especialidad;
use Livewire\Livewire;
use Tests\TestCase;

class EspecialidadTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Especialidad::class);

        $component->assertStatus(200);
    }
}
