<?php

namespace Tests\Feature\Livewire\Principal;

use App\Http\Livewire\Principal\ListDoctor;
use Livewire\Livewire;
use Tests\TestCase;

class ListDoctorTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ListDoctor::class);

        $component->assertStatus(200);
    }
}
