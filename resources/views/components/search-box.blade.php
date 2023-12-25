@props([
    'isbotoncreatevisible'=>false,
    'isbotoncancelvisible'=>false,
    'namefuncionbtn'=>false,
    'wireinputname'=>false,
    'numpage'=>false
     ])

<div class="card lg:flex">

    <div class="flex relative mt-1 items-center">
        <label
                class="label absolute block bg-input top-0 ltr:ml-3 rtl:mr-3
                       px-1 rounded font-heading uppercase"
                for="boxsearch">Buscar.</label>
        <input wire:model="{{$wireinputname}}" id="boxsearch"
               autofocus maxlength="32" autocomplete="off"
               class="form-control w-96 mt-1 pt-4 py-0.5 ml-1"
               placeholder="Ingrese dato de busquedad...">
        <svg
                style="display: none"
                wire:loading
                wire:target="{{$wireinputname}}"
                aria-hidden="true"
                class="absolute ml-72  w-6 h-6 text-gray-300 animate-spin dark:text-gray-600 fill-primary-700"
                viewBox="0 0 100 101" fill="none">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                  fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                  fill="currentFill"/>
        </svg>
        @if($isbotoncreatevisible)
            @can('CREATE')
                <button
                        wire:loading.attr="disabled"
                        wire:click.prevent="{{$namefuncionbtn}}"
                        class="btn btn-icon btn-icon_small btn_primary mt-1 ml-1">
                    <span class="la la-plus"></span>
                </button>
            @endcan
        @endif
        @if($isbotoncancelvisible)
            <button
                    wire:click="resetForm"
                    wire:click.prevent="resetForm"
                    class="btn btn-icon btn-icon_small btn_danger mt-1 ml-1">
                <span class="la  la-remove"></span>
            </button>
        @endif

    </div>

    <div class="flex items-center ltr:ml-auto rtl:mr-auto p-3 border-t lg:border-t-0 border-divider">

    </div>
    <div x-data="{ isOpen: false, timeout: null }"
         class="flex items-center gap-2 p-3 border-t lg:border-t-0 lg:ltr:border-l lg:rtl:border-r border-divider">
        <span>Mostrar</span>
        <div @mouseover="isOpen = true" class="dropdown">
            <button

                    class="btn btn_outlined btn_secondary" data-toggle="dropdown-menu" type="button">
                {{$numpage}}
                <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
            </button>
            <div
                   
                    class="dropdown-menu">
                <a class="cursor-pointer" @click="Livewire.emit('numofpage','10')"
                >10
                </a>
                <a class="cursor-pointer" @click="Livewire.emit('numofpage','20')">20</a>
                <a class="cursor-pointer" @click="Livewire.emit('numofpage','45')">45</a>
                <a class="cursor-pointer" @click="Livewire.emit('numofpage','60')">60</a>
            </div>
        </div>
        <span>items</span>
    </div>
</div>
@error($wireinputname)
<div class=" bottom-0"><small class="block mt-1 ml-2 invalid-feedback">{{ $message }}</small></div>
@enderror

