<?php

namespace App\Http\Livewire\Utility;

use Livewire\Component;

class Reusecomponent extends Component
{
    public $content = '';

    public $inmodel = '';

    protected $listeners = ['openModal', 'closeModal'];

    public function openModal(array $componentname)
    {
        $this->content = $componentname['moduloname'];
        if (isset($componentname['id'])) {
            $this->inmodel = $componentname['id'];
        }
    }

    public function closeModal()
    {
        $this->content = '';
    }

    public function render()
    {

        if (empty($this->content)) {
            return <<<'blade'
            <div>
              
            </div>
        blade;
        } else {
            if (empty($this->inmodel)) {
                return <<<'blade'
            <div>
                @livewire($this->content)
            </div>
        blade;
            } else {
                return <<<'blade'
            <div>
                @livewire($this->content, ['idmodel' => $this->inmodel], key($this->inmodel))
            </div>
        blade;
            }
        }
    }
}
