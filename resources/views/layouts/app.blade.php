@include('partials._header', ['title' => $title ?? ''])

<body>

@include('partials._navigation')

<!-- Workspace -->
<main class="workspace @hasSection('sidebar') workspace_with-sidebar @endif {{ $workspaceClasses ?? '' }}">

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
