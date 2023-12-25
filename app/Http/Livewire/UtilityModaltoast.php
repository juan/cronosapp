<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UtilityModaltoast extends Component
{
    public $message;

    public $color;

    public $icon;

    public $show = false;

    public $okicon = 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z';

    public $cancelicon = 'M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z';

    protected $listeners = ['update', 'create'];

    public function update($modelresults)
    {

        $countchange = count($modelresults);

        if ($countchange == 0) {
            $this->setMessage('No se registraron cambios !',
                '#f5334d',
                $this->cancelicon);
        } else {
            $this->setMessage('Actualización exitosa !',
                '#149142',
                $this->okicon);
        }
        $this->show = true;
    }

    public function setMessage($themssage, $thcolor, $thicon)
    {
        $this->message = $themssage;
        $this->color = $thcolor;
        $this->icon = $thicon;
    }

    public function create($estatuscreate)
    {

        if ($estatuscreate) {
            $this->setMessage('Registro exitoso !',
                '#149142',
                $this->okicon);

        } else {
            $this->setMessage('Error en registro !',
                '#f5334d',
                $this->cancelicon);

        }
        $this->show = true;
    }

    public function render()
    {

        return <<<'HTML'
         <div style="display: none"
            x-data="{show: @entangle('show') }"
            x-show="show"
            x-model="show==true, setTimeout(() => {show=false}, 3300)"
            class="bottom-0 z-20 right-0 mr-2  mb-8  pr-4 fixed px-5 py-3 rounded bg-fondotoast 
                 shadow-sm ring-1 ring-offset-gray-800"
            data-animations="fadeInRight, fadeOutRight"     
         >
           <div class="flex items-start"> 
            <div class="flex-shrink-0">
             <svg class="h-6 w-6"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{$color}}" aria-hidden="true">
               <path stroke-linecap="round" stroke-linejoin="round" d="{{$icon}}" />
             </svg>
            </div>
            <div >
             <p class="text-sm font-medium mt-1" style="color: {{$color}}">Aviso.</p>
              <div class="toast-body ">
               <p ><strong> {{$message}}</strong></p>
            </div>
          </div>
          <div class="ml-3 flex flex-shrink-0">
            <button type="button" class="inline-flex rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Close</span>
              <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
              </svg>
            </button>
          </div>
         </div>   
         </div>
       HTML;
    }
}
