<div>

    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Usuario"
                     opciones="Registro,Principal,Usuario"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="getUsuario,listUser"
        >
        </x-breadcrum>
    </section>
    <form wire:submit.prevent="getUsuario" enctype="multipart/form-data">
        @csrf
        <x-bodyform formtitle="Registro usuario">
            <x-opcionsbladeform namefunction="listUser"></x-opcionsbladeform>
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Nombre" idbox="usrname"
                                    wireid="datauser.name"
                                    maxlength="42" isrequired="yes"
                                    autofocus isdisabled="{{$isdisabled}}">
                    </x-boxtextinput>
                </div>
                <div class="relative sm:col-span-3">

                    <x-boxtextinput label="Apellido" idbox="usrlasname"
                                    wireid="datauser.lastname"
                                    maxlength="42" isrequired="yes"
                                    isdisabled="{{$isdisabled}}"
                    >
                    </x-boxtextinput>
                </div>
                <div class="flex sm:col-span-3 gap-x-1">
                    <div class="relative  sm:col-span-1 w-24">
                        <x-input_select_form
                                label="Tipo" idbox="usrtipdocu"
                                wireid="datauser.identity_id"
                                isdisabled="{{$isdisabled}}"
                        >
                            @foreach($ListIdentity as $dataidenty)
                                <option
                                        value="{{$dataidenty->id}}">{{$dataidenty->name_identity}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>

                    <div class="relative w-full">
                        <x-boxtextinput label="Documento" idbox="usrdocum"
                                        wireid="datauser.dni"
                                        maxlength="15" isrequired="yes"
                                        x-data="" x-mask="999999999999999"
                                        isdisabled="{{$isdisabled}}"
                        >
                        </x-boxtextinput>
                    </div>
                </div>
                <div class="relative sm:col-span-2">
                    <x-input_select_form
                            label="Genero" idbox="usrgenero"
                            wireid="datauser.gender_id"
                            icondpd="y" isdisabled="{{$isdisabled}}"
                    >
                        @foreach($listGender as $datgender)
                            <option value="{{$datgender->id}}">{{$datgender->name_gender}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>
                <div class="relative sm:col-span-2">
                    <x-boxdateinput
                            label="Fecha Nacimiento" idbox="fenacimi"
                            wireid="datauser.datebirth"
                            maxlength="11" isrequired="yes"
                            maximdia="hoy" placeholder="dd/mm/aaaa"
                            isdisabled="{{$isdisabled}}"
                    >
                    </x-boxdateinput>
                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Correo" idbox="usrcorreo"
                                    wireid="datauser.email" isrequired="yes"
                                    maxlength="30" isdisabled="{{$isdisabled}}"
                    ></x-boxtextinput>
                </div>
                <div class="relative sm:col-span-2">
                    <x-input_select_form
                            label="Estatus" idbox="usrstatus"
                            wireid="datauser.state_id"
                            icondpd="y" isdisabled="{{$isdisabled}}"
                    >
                        <option disabled selected value></option>
                        @foreach($liststatus as $datastatus)
                            <option value="{{$datastatus->id}}">{{$datastatus->state_name}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>
                <div class="relative sm:col-span-2">
                    <x-boxtextinput label="Teléfono" idbox="usephone"
                                    wireid="datauser.phone"
                                    maxlength="13" isrequired="yes"
                                    x-data="" x-mask="9999999999999"
                                    isdisabled="{{$isdisabled}}"
                    ></x-boxtextinput>
                </div>
                <div class="relative sm:col-span-5">
                    <x-boxtextinput label="Dirección" idbox="usrdireccion"
                                    wireid="datauser.address"
                                    maxlength="30"
                                    isdisabled="{{$isdisabled}}"
                    ></x-boxtextinput>
                </div>
                <div class="relative sm:col-span-2">
                    <x-input_select_form
                            label="Perfil" idbox="usrperfil"
                            wireid="datauser.role_id" isrequired="yes"
                            icondpd="y" isdisabled="{{$isdisabled}}"
                    >
                        <option disabled selected value></option>
                        @foreach($listRoles as $dataroles)
                            <option value="{{$dataroles->id}}">{{$dataroles->name_role}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>
            </div>


            <div class="w-1/5 grid grid-cols-1 sm:grid-cols-1 bg-gray-200
                       rounded shadow-md text-center items-center">

                <div class="flex items-center m-2">

                    <div class="mt-0 flex items-center gap-x-3">
                        <x-input_avatar
                                wireid="datauser.profile_photo_path"
                                labelname="Foto"
                                namefoto="{{$namefoto}}"
                        >
                        </x-input_avatar>
                    </div>
                </div>

            </div>

            <div class="mt-4 i footer flex justify-end">
                <button
                        wire:click.prevent="cleanForm"
                        type="button"
                        class="btn btn_danger shadow-lg shadow-danger uppercase">Cancelar
                </button>
                <button
                        {{$isdisabled}}
                        wire:loading.attr="disabled"
                        wire:click.prevent="getUsuario"
                        class="btn btn_success shadow-lg shadow-success  uppercase ltr:ml-2 rtl:mr-2">
                    <span
                            wire:loading
                            wire:target="getUsuario"
                            class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                    </span>
                    Guardar
                </button>
            </div>

        </x-bodyform>
    </form>
</div>
