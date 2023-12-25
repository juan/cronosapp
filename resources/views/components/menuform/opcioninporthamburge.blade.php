<div
        x-show="menudrop"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        style="display: none"
        class="absolute right-0 z-10 mt-1 w-40 origin-top-right divide-y divide-gray-100
                            rounded-md bg-primary-50 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
    <div @click="menudrop=false"
         class="py-1" role="none"

    >
        @can('CREATE')
            <x-menuform.opcionnewhamburge

                    namefuncion="openModal" nameopcion="Tipo Prestador"/>
        @endcan
    </div>
</div>