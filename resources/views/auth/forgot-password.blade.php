@extends('layouts.blank', ['title' => 'Olvidó contraseña'])

@section('body')
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

    <!-- Session Status -->


    <div class="container flex items-center justify-center mt-20 py-10">

        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">Olvidó contraseña?</h2>
                <h4 class="uppercase">Ingrese correo de recuperación.</h4>
            </div>
            <div class="mx-5 md:mx-10">
                <x-auth-session-status class="mb-4 text-info " :status="session('status')"/>
            </div>

            <form class="card mt-5 p-5 md:p-10" method="POST" action="{{ route('password.email')}}">

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

                <!-- Botones -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-end mt-4">
                        <button class="btn_primary p-2 rounded text-white shadow-success py-2 hover:bg-none hover:text-white">
                            {{ __('Resetear contraseña') }}
                        </button>
                    </div>

                </div>


            </form>
        </div>
    </div>

@endsection

