@props([
    'namefunction'=>false,
])

<div class="relative">
    <div
            wire:click.prevent="{{$namefunction}}"
            wire:target="{{$namefunction}}"
            class="p-2 w-12 h-12 absolute right-0 -top-20 flex items-center
                        justify-center bg-fondotabla shadow-lg rounded-lg
                        border border-primary-400 cursor-pointer">
        <svg type="button"

             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
        </svg>

    </div>
</div>