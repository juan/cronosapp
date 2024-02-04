@extends('layouts.blank', ['title' => 'Login'])

@section('body')
    <!-- Session Status -->
    <!-- Top Bar -->
    <section class="top-bar">

        <!-- Brand -->
        <span class="brand">Cronos</span>

        <nav class="flex items-center ltr:ml-auto rtl:mr-auto">

            <!-- Fullscreen -->
            <button id="fullScreenToggler"
                    class="hidden lg:inline-block ltr:ml-5 rtl:mr-5 text-2xl leading-none la la-expand-arrows-alt"
                    data-toggle="tooltip" data-tippy-content="Fullscreen"></button>

            <!-- Register -->

        </nav>
    </section>
    <x-auth-session-status class="mb-4" :status="session('status')"/>
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">Bienvenido</h2>
                <h4 class="uppercase">Ingreso al sistema.</h4>
            </div>

            <form class="card mt-5 p-5 md:p-10" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="relative mt-5">
                    <label
                            class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                            for="email">Correo.</label>
                    <input id="email" class="form-control mt-2 pt-3.5" type="email" name="email"
                           value="{{old('email')}}"
                           required autofocus autocomplete="off">
                    @error('email')
                    <small class="block mt-2 invalid-feedback">{{$message}}</small>
                    @enderror
                </div>

                <!-- Password -->

                <div class="relative mt-5 mb-5">

                    <label
                            class="label absolute block bg-input border border-border rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
                            for="password">Contraseña.</label>
                    <input id="password" class="form-control mt-2 pt-3.5" type="password" name="password"
                           required autocomplete="off">
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-between">
                    <div class="w-1/2">
                        <a href="{{ route('password.request') }}" class="text-sm uppercase">Olvido contraseña?</a>
                    </div>
                    <div class="w-16">
                        <button class="btn_primary p-2 rounded text-white shadow-success py-2 hover:bg-none hover:text-white">
                            Ingreso
                        </button>
                    </div>

                </div>


            </form>
        </div>
    </div>
@endsection
