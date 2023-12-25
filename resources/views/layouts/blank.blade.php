@include('partials._header', ['title' => $title ?? ''])

<body>

    @include('partials._customizer')

    @yield('body')

    <!-- Scripts -->
    <script src="{{ asset('build/js/vendor.js') }}"></script>
    
    @yield('scripts')
    
    <script src="{{ asset('build/js/script.js') }}"></script>

</body>

</html>
