<div>
    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Permisos"
                     opciones="Configuración,Sistema,Permisos"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="getPermisos,listPermisos"
        >
        </x-breadcrum>
    </section>
    <form wire:submit.prevent="getPermisos">
        @csrf
        <x-bodyform formtitle="Configuración de permisos">
            <x-opcionsbladeform namefunction="listPermisos"></x-opcionsbladeform>
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-1">
                <div class="relative sm:col-span-1">
                    <x-input_select_form
                            label="Perfil" idbox="perfil"
                            wireid="arrayactionrole.role_id"
                            icondpd="y" isrequired="y" isdisabled="{{$isdisabled}}"
                    >
                        <option disabled selected value></option>
                        @foreach($listRoles as $datpermiso)
                            <option value="{{$datpermiso->id}}">{{$datpermiso->name_role}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>
            </div>
            <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-0.5 sm:grid-cols-4 border rounded border-primary-300">
                @if(count($listAccion)>0)
                    @foreach($listAccion as $datacion)
                        <div class="relative sm:col-span-1 mt-3 ml-3 mb-3">

                            <x-chekboxstyleform
                                    label="{{$datacion->sp_action}}"
                                    idbox="{{$loop->iteration}}"
                                    wireid="arrayactionrole.action_id"
                                    valcaja="{{$datacion->id}}"
                                    isdisabled="{{$isdisabled}}"
                            >
                            </x-chekboxstyleform>

                        </div>

                    @endforeach
                    <p></p>
                @endif
            </div>
            @error('action_id')
            <small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
            @enderror


            <div class="mt-4 i footer flex justify-end" scroll-smooth md:scroll-auto>
                <button
                        wire:click.prevent="cleanForm"
                        type="button"
                        class="btn btn_danger shadow-lg shadow-danger uppercase">Cancelar
                </button>

                <button
                        {{$isdisabled}}
                        wire:loading.attr="disabled"
                        wire:click.prevent="getPermisos"
                        class="btn btn_success shadow-lg shadow-success  uppercase ltr:ml-2 rtl:mr-2">
                    <span
                            wire:loading
                            wire:target="getPermisos"
                            class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                    </span>
                    Guardar
                </button>

            </div>
        </x-bodyform>
    </form>
</div>
