<?php

namespace Tests\Feature\Livewire\Config;

use App\Http\Livewire\Config\Roles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RolesTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Roles::class);

        $component->assertStatus(200);
    }
}
