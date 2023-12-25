<?php

namespace Tests\Feature\Livewire\Principal;

use App\Http\Livewire\Principal\RegUsuario;
use Livewire\Livewire;
use Tests\TestCase;

class RegUsuarioTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(RegUsuario::class);

        $component->assertStatus(200);
    }
}
