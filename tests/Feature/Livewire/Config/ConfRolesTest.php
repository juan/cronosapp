<?php

namespace Tests\Feature\Livewire\Config;

use App\Http\Livewire\Config\ConfRoles;
use Livewire\Livewire;
use Tests\TestCase;

class ConfRolesTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ConfRoles::class);

        $component->assertStatus(200);
    }
}
