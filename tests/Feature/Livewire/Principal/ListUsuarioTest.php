<?php

namespace Tests\Feature\Livewire\Principal;

use App\Http\Livewire\Principal\ListUsuario;
use Livewire\Livewire;
use Tests\TestCase;

class ListUsuarioTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ListUsuario::class);

        $component->assertStatus(200);
    }
}
