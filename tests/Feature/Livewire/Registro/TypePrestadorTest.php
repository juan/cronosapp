<?php

namespace Tests\Feature\Livewire\Registro;

use App\Http\Livewire\Registro\TypePrestador;
use Livewire\Livewire;
use Tests\TestCase;

class TypePrestadorTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(TypePrestador::class);

        $component->assertStatus(200);
    }
}
