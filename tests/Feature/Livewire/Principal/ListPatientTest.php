<?php

namespace Tests\Feature\Livewire\Principal;

use App\Http\Livewire\Principal\ListPatient;
use Livewire\Livewire;
use Tests\TestCase;

class ListPatientTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ListPatient::class);

        $component->assertStatus(200);
    }
}
