<?php

namespace Tests\Feature\Livewire\Config;

use App\Http\Livewire\Config\ListActionRoles;
use Livewire\Livewire;
use Tests\TestCase;

class ListActionRolesTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ListActionRoles::class);

        $component->assertStatus(200);
    }
}
