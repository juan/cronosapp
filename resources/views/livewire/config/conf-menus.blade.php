<div x-data="{ isShowing: false }"
     @scroll.window="isShowing = (window.pageYOffset > 180) ? true : false">
    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Acceso"
                     opciones="Configuración,Sistema,Acceso"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="getMenus,listMenus"
        >
        </x-breadcrum>
    </section>
    <form wire:submit.prevent="getMenus">
        @csrf

        <x-bodyform formtitle="Accesos de menú">
            <x-opcionsbladeform namefunction="listMenus"></x-opcionsbladeform>
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-2 mb-4 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-1">
                <div class="relative sm:col-span-1">
                    <x-input_select_form
                            label="Perfil" idbox="perfil"
                            wireid="menuspefil.role_id"
                            icondpd="y" isrequired="y" isdisabled="{{$isdisabled}}"
                    >
                        <option disabled selected value></option>
                        @foreach($listRoles as $datpermiso)
                            <option value="{{$datpermiso->id}}">{{$datpermiso->name_role}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>
            </div>
            <div class="flow-root border rounded border-primary-300">
                <ul role="list" class="mb-2 mt-2">
                    @foreach($listMenus as $datamen)

                        <li class="ml-3 mr-3">
                            <div class="relative pb-2">
                                <div class="relative flex space-x-3">
                                    <div>
                                            <span class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center ring-1 ring-primary-400">
                                              <span class="{{$datamen->bigicon}}"></span>
                                            </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-500">{{$datamen->namemenu}}</p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                            <p class="text-sm text-gray-700">Activar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @php
                            $tiuloid=0;
                        @endphp
                        @foreach($datamen->optionmenus as $opcion)
                            @if($opcion->titulo=='s')
                                @php
                                    $tiuloid=$opcion->id;
                                @endphp
                                <h6 class="uppercase ml-9">{{$opcion->namemenu}}</h6>
                            @else
                                <li class="flex gap-x-4 ">
                                    <div class="relative ml-9 flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
                                                class="font-medium text-gray-900">{{$opcion->namemenu}}</span>
                                    </p>
                                    <div class="flex flex-col gap-y-5 mt-0.5">
                                       
                                        <x-chekboxstyleform
                                                idbox="{{$loop->iteration}}"
                                                wireid="menuspefil.menu_id"
                                                valcaja="{{$datamen->id.'|'.$tiuloid.'|'.$opcion->id}}"
                                                isdisabled="{{$isdisabled}}"
                                        >
                                        </x-chekboxstyleform>

                                    </div>
                                </li>
                            @endif
                        @endforeach
                        @php
                            $tiuloid=0;
                        @endphp
                    @endforeach


                </ul>
            </div>
            @error('menu_id')
            <small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
            @enderror


            <x-botunup></x-botunup>


            <div class="mt-4 i footer flex justify-end">
                <button
                        wire:click.prevent="cleanForm"
                        type="button"
                        class="btn btn_danger shadow-lg shadow-danger uppercase">Cancelar
                </button>

                <button
                        {{$isdisabled}}
                        wire:loading.attr="disabled"
                        wire:click.prevent="getMenus"
                        class="btn btn_success shadow-lg shadow-success  uppercase ltr:ml-2 rtl:mr-2">
                    <span
                            wire:loading
                            wire:target="getMenus"
                            class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                    </span>
                    Guardar
                </button>

            </div>
        </x-bodyform>
    </form>
</div>