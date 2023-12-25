<?php

namespace Tests\Feature\Livewire\Config;

use App\Http\Livewire\Config\ConfPermisos;
use Livewire\Livewire;
use Tests\TestCase;

class ConfPermisosTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ConfPermisos::class);

        $component->assertStatus(200);
    }
}
