<div>
    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Usuario"
                     opciones="Registro,Principal,Usuario"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="$FUNCTION1,$FUNCTION2"
        >
        </x-breadcrum>
    </section>
    <form wire:submit.prevent="getUsuario">
        @csrf
        <x-bodyform formtitle="Registro usuario">
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Nombre" idbox="usrname"
                                    wireid="datauser.name"
                                    maxlength="42" isrequired="yes"
                                    autofocus>
                    </x-boxtextinput>
                </div>
                <div class="relative sm:col-span-3">

                    <x-boxtextinput label="Apellido" idbox="usrlasname"
                                    wireid="datauser.lastname"
                                    maxlength="42" isrequired="yes"
                    >
                    </x-boxtextinput>
                </div>
                <div class="flex sm:col-span-3 gap-x-1">
                    <div class="relative  sm:col-span-1 w-24">
                        <x-input_select_form
                                label="Tipo" idbox="usrtipdocu"
                                wireid="datauser.identity_id"
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
                        >
                        </x-boxtextinput>
                    </div>
                </div>
                <div class="relative sm:col-span-2">
                    <x-input_select_form
                            label="Genero" idbox="usrgenero"
                            wireid="datauser.gender_id"
                            icondpd="y"
                    >
                        @foreach($listGender as $datgender)
                            <option value="{{$datgender->id}}">{{$datgender->name_gender}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>

                <div class="relative sm:col-span-2">
                    <x-boxdateinput
                            label="Fecha Nacimiento" idbox="usrfenaci"
                            wireid="datauser.datebirth"
                            maxlength="11" isrequired="yes"
                            maximdia="hoy" placeholder="dd/mm/aaaa"
                    >
                    </x-boxdateinput>
                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Correo" idbox="usrcorreo"
                                    wireid="datauser.email" isrequired="yes"
                                    maxlength="30"
                    ></x-boxtextinput>
                </div>
                <div class="relative sm:col-span-2">
                    <x-input_select_form
                            label="Estatus" idbox="usrstatus"
                            wireid="datauser.state_id"
                            icondpd="y"
                    >
                        <option disabled selected value></option>
                        @foreach($liststatus as $datastatus)
                            <option value="{{$datastatus->id}}">{{$datastatus->state_name}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Teléfono" idbox="usephone"
                                    wireid="datauser.phone"
                                    maxlength="13" isrequired="yes"
                                    x-data="" x-mask="9999999999999"
                    ></x-boxtextinput>
                </div>
                <div class="relative sm:col-span-6">
                    <x-boxtextinput label="Dirección" idbox="usrdireccion"
                                    wireid="datauser.address"
                                    maxlength="30"

                    ></x-boxtextinput>
                </div>
            </div>
            <div class="grid lg:grid-cols-2 gap-5">
                <div class="card p-5 min-w-0 border border-primary-300 shadow-md shadow-gray-700">
                    <h3>Ingreso al sistema</h3>
                    <div class="flex mt-1 text-sm text-primary-800">

                        <span class="sr-only">Info</span>
                        <div>
                            Contraseña debe tener 9 caracteres, al menos una mayuscula y un caracter especial
                            [!, ¡, ?, ¿, #]
                        </div>
                    </div>
                    <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-1">
                        <div class="relative sm:col-span-1">
                            <x-passwordinput label="Contraseña" idbox="usrpassword"
                                             wireid="datauser.password"
                                             maxlength="9" isrequired="yes"
                                             autofocus>
                            </x-passwordinput>
                        </div>
                        <div class="relative sm:col-span-1">
                            <x-passwordinput label="Confirmar contraseña" idbox="usrconfpassword"
                                             wireid="datapaciente.name_patient"
                                             maxlength="9" isrequired="yes"
                                             autofocus>
                            </x-passwordinput>
                        </div>

                    </div>
                </div>
                <div class="card p-5 flex flex-col border border-primary-300 shadow-md shadow-gray-700">
                    <h3>Perfil de usuario</h3>
                    <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-1">
                        <div class="relative sm:col-span-1">
                            <x-input_select_form
                                    label="Perfil" idbox="usrperfil"
                                    wireid="datauser.role_id"
                                    icondpd="y"
                            >
                                <option disabled selected value></option>
                                @foreach($listRoles as $dataroles)
                                    <option value="{{$dataroles->id}}">{{$dataroles->name_role}}</option>
                                @endforeach
                            </x-input_select_form>
                        </div>

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
