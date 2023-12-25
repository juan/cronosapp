<?php

namespace Tests\Feature\Livewire\Config;

use App\Http\Livewire\Config\ListMenus;
use Livewire\Livewire;
use Tests\TestCase;

class ListMenusTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ListMenus::class);

        $component->assertStatus(200);
    }
}
