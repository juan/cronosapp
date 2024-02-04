@include('partials._header', ['title' => $title ?? ''])

<body>

@include('partials._navigation')

<!-- Workspace -->
<main class="workspace @hasSection('sidebar') workspace_with-sidebar @endif {{ $workspaceClasses ?? '' }}">

    <div class="static hidden">
        <div id="sticky-banner" tabindex="-1"
             class="fixed  right-0 flex top-20  z-50  justify-between w-1/2 bg-gray-200 p-4 rounded">
            <div class="flex">
                <div>i</div>
                <div class="ml-2">2</div>
            </div>
            <div class=" flex items-center
            ">
                <button data-dismiss-target="#sticky-banner" type="button"
                        class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close banner</span>
                </button>
            </div>
        </div>
    </div>

    @yield('workspace')
    <livewire:utility-modaltoast/>
    <livewire:utility.reusecomponent/>

    @if(!isset($footer) or $footer)
        @include('partials._footer')
    @endif

</main>

@hasSection('sidebar')

    <!-- Sidebar -->
    <aside class="sidebar">

        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>


        @yield('sidebar')

    </aside>

@endif

<!-- Scripts -->
<script src="{{ asset('build/js/vendor.js') }}"></script>

@yield('scripts')

<script src="{{ asset('build/js/script.js') }}"></script>

@livewireScripts
@stack('scriptsapp')

</body>
