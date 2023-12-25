@extends('layouts.blank', ['title' => 'Login'])

@section('body')
    <!-- Session Status -->
    <!-- Top Bar -->
    <section class="top-bar">

        <!-- Brand -->
        <span class="brand">Cronos</span>

        <nav class="flex items-center ltr:ml-auto rtl:mr-auto">

            <!-- Dark Mode -->
            <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
                <input id="darkModeToggler" type="checkbox">
                <span></span>
            </label>

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
                <div class="flex items-center">
                    <a href="{{ url('pages/auth/forgot-password') }}" class="text-sm uppercase">Olvido contraseña?</a>
                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Remember Me
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
















































                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            -->
            </form>
        </div>
    </div>
@endsection
