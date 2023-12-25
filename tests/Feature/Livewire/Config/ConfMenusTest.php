<?php

namespace Tests\Feature\Livewire\Config;

use App\Http\Livewire\Config\ConfMenus;
use Livewire\Livewire;
use Tests\TestCase;

class ConfMenusTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ConfMenus::class);

        $component->assertStatus(200);
    }
}
