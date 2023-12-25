<?php

namespace Tests\Feature\Livewire\Utility;

use App\Http\Livewire\Utility\Modalwindow;
use Livewire\Livewire;
use Tests\TestCase;

class ModalwindowTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Modalwindow::class);

        $component->assertStatus(200);
    }
}
