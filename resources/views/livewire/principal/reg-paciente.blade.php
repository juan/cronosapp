<div>

    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Paciente"
                     opciones="Registro,Principal,Paciente"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="getPaciente,listPatient"
        >
        </x-breadcrum>
    </section>
    <form wire:submit.prevent="getPaciente">
        @csrf


        <x-bodyform formtitle="Registro paciente">
            <x-opcionsbladeform namefunction="listPatient"></x-opcionsbladeform>
           

            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-9">
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Nombre" idbox="paciennombre"
                                    wireid="datapaciente.name_patient"
                                    maxlength="42" isrequired="yes"
                                    autofocus isdisabled="{{$isdisabled}}">
                    </x-boxtextinput>


                </div>
                <div class="relative sm:col-span-3">

                    <x-boxtextinput label="Apellido" idbox="pacienape"
                                    wireid="datapaciente.lastname_patient"
                                    maxlength="42" isrequired="yes"
                                    isdisabled="{{$isdisabled}}"
                    >
                    </x-boxtextinput>

                </div>
                <div class="flex sm:col-span-3 gap-x-1">
                    <div class="relative  sm:col-span-1 w-24">
                        <x-input_select_form
                                label="Tipo" idbox="tipdocpaci"
                                wireid="datapaciente.identity_id"
                                isdisabled="{{$isdisabled}}"
                        >
                            @foreach($ListIdentity as $dataidenty)
                                <option
                                        value="{{$dataidenty->id}}">{{$dataidenty->name_identity}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>

                    <div class="relative w-full">
                        <x-boxtextinput label="Documento" idbox="nuemrpatien"
                                        wireid="datapaciente.numberid_patient"
                                        maxlength="15" isrequired="yes"
                                        x-data="" x-mask="999999999999999"
                                        isdisabled="{{$isdisabled}}"
                        >
                        </x-boxtextinput>
                    </div>
                </div>
                <div class="relative sm:col-span-2">
                    <x-boxtextinput label="CUIL" idbox="cuilpatien"
                                    wireid="datapaciente.cuil_patient"
                                    maxlength="15"
                                    x-data="" x-mask="999999999999999"
                                    isdisabled="{{$isdisabled}}"
                    >
                    </x-boxtextinput>
                </div>
                <div class="relative sm:col-span-2">
                    <x-input_select_form
                            label="Genero" idbox="generopaci"
                            wireid="datapaciente.gender_id"
                            icondpd="y"
                            isdisabled="{{$isdisabled}}"
                    >
                        @foreach($listGender as $datgender)
                            <option value="{{$datgender->id}}">{{$datgender->name_gender}}</option>
                        @endforeach
                    </x-input_select_form>
                </div>

                <div class="relative sm:col-span-2">
                    <x-boxdateinput
                            label="Fecha Nacimiento" idbox="fenacimi"
                            wireid="datapaciente.datebirth"
                            maxlength="11" isrequired="yes"
                            maximdia="hoy" placeholder="dd/mm/aaaa"
                            isdisabled="{{$isdisabled}}"
                    >
                    </x-boxdateinput>
                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Correo" idbox="correopan"
                                    wireid="datapaciente.email_patient"
                                    maxlength="30"
                                    isdisabled="{{$isdisabled}}"
                    ></x-boxtextinput>
                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Teléfono" idbox="telefpan"
                                    wireid="datapaciente.cellphone"
                                    maxlength="13" isrequired="yes"
                                    x-data="" x-mask="9999999999999"
                                    isdisabled="{{$isdisabled}}"
                    ></x-boxtextinput>
                </div>
                <div class="relative sm:col-span-6">
                    <x-boxtextinput label="Dirección" idbox="direcipan"
                                    wireid="datapaciente.direccion_patient"
                                    maxlength="30"
                                    isdisabled="{{$isdisabled}}"
                    ></x-boxtextinput>
                </div>
            </div>
            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-64 h-1 my-2 bg-gray-300 border-0 rounded dark:bg-gray-800 shadow">
            </div>
            @if(empty($isdisabled))
                <div class="flex gap-x-1.5">
                    <div class="relative w-32 flex-none">
                        <x-input_select_form
                                x-data=""
                                x-on:change="$wire.set('insurancedata.insurance_id','');
                                             $wire.set('insurancedata.insurance_plan_id','');
                                             $wire.set('insurancedata.numafiliado','');"
                                wire:change="getInsuranceTypeid"
                                wire:target="getInsuranceTypeid"
                                label="Tipo" idbox="tipopresta"
                                wireid="insurancedata.insurance_type_id"
                        >
                            <option disabled selected value></option>
                            @foreach($ListTypeprestador as $datatypinsura)
                                <option value="{{$datatypinsura->id}}">{{$datatypinsura->name_type}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>

                    <div class="relative flex-initial w-72">

                        <x-input_select_form
                                x-data=""
                                x-on:change="$wire.set('insurancedata.insurance_plan_id','');
                                             $wire.set('insurancedata.numafiliado','');"
                                wire:change.prevent="getInsurancePlan"
                                label="Prestador" idbox="prestaname"
                                wireid="insurancedata.insurance_id"
                        >
                            <option disabled selected value></option>
                            @foreach($arrayinsurance as $dataInsurance)
                                <option value="{{$dataInsurance->id}}">{{$dataInsurance->name_insurance}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>
                    <div class="relative grid-flow-col w-72">
                        <x-input_select_form
                                label="Plan" idbox="planname"
                                wireid="insurancedata.insurance_plan_id"
                        >
                            <option disabled selected value></option>
                            @foreach($arrayplan as $dataplan)
                                <option value="{{$dataplan->id}}">{{$dataplan->name_insplan}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>
                    <div class="relative  w-56">
                        <x-boxtextinput label="Num. Afiliado" idbox="numafiprest"
                                        wireid="insurancedata.numafiliado"
                                        maxlength="30"
                        ></x-boxtextinput>
                    </div>

                    <div class="flex mt-1.5">
                        <div>
                            @if(empty($idInsuracPatien))
                                <button
                                        wire:loading.attr="disabled"
                                        wire:click.prevent="loadInsurances"
                                        wire:target="loadInsurances"
                                        class="btn btn-icon btn-icon_small btn_primary mt-1 ml-1">
                                    <span class="la la-plus"></span>
                                </button>
                            @else
                                <button
                                        wire:loading.attr="disabled"
                                        wire:click.prevent="insuracepatientUpdate"
                                        wire:target="insuracepatientUpdate"
                                        class="btn btn-icon btn-icon_small btn_success mt-1 ml-1">
                                    <span class="la la-save"></span>
                                </button>
                            @endif
                        </div>
                        <div>
                            <button
                                    wire:click.prevent="resetArrayInsurance"
                                    class="btn btn-icon btn-icon_small btn_danger mt-1 ml-1">
                                <span class="la  la-remove"></span>
                            </button>
                        </div>
                    </div>

                </div>
            @endif
            <div class="mt-1.5">
                @php
                    if(empty($isdisabled)){
                        $opcin=',Opciones';
                    }else{
                        $opcin='';
                    }
                @endphp
                <x-smalltable cabecera="Tipo,Prestador,Plan,Num. Afiliado{{$opcin}}">
                    @if(!empty($tablaseguros))
                        @foreach($tablaseguros as $key => $datainsplans)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>{{$datainsplans['typeprestador']}}</td>
                                <td>{{$datainsplans['nameinsurace']}}</td>
                                <td>{{$datainsplans['nameplan']}}</td>
                                <td class="font-bold">{{$datainsplans['numafiliado']}}</td>
                                <td>
                                    @if(empty($isdisabled))
                                        @if(!isset($datainsplans['insurapatiendid']))
                                            @if(empty($isdisabled))
                                                <x-opcion-table deleteon="yes">
                                                    <x-slot:funciodelete>
                                                        confirmRemoveItem({{$key}})
                                                    </x-slot:funciodelete>
                                                </x-opcion-table>
                                            @endif
                                        @else
                                            <x-opcion-table deleteon="yes" editon="yes">
                                                <x-slot:funciodelete>
                                                    removeInsuracePatient({{$datainsplans['insurapatiendid']}})
                                                </x-slot:funciodelete>
                                                <x-slot:funcioupdate>
                                                    updateInsurancePatient({{$datainsplans['insurapatiendid']}})
                                                </x-slot:funcioupdate>
                                            </x-opcion-table>
                                        @endif
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    @endif
                </x-smalltable>
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
                        wire:click.prevent="getPaciente"
                        class="btn btn_success shadow-lg shadow-success  uppercase ltr:ml-2 rtl:mr-2">
                    <span
                            wire:loading
                            wire:target="getPaciente"
                            class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                    </span>
                    Guardar
                </button>
            </div>
        </x-bodyform>
    </form>
</div>
@push('scriptsapp')
    <script src="{{ Vite::asset('node_modules/sweetalert2/dist/sweetalert2.all.js') }}"></script>
@endpush

<script>

    window.addEventListener('confirm', function (e) {
        Swal.fire({
            title: '<div style="font-size:18px;' +
                'font-weight:bold;">$title</div>'.replace('$title', 'Desea eliminar registro ?'),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            width: 300,
            imageHeight: 20,
            cancelButtonText:
                'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('removeItemArray', e.detail.id)
            }
        })
    });

    window.addEventListener('avisoResultado', function (e) {
        Swal.fire({
            toast: true,
            icon: 'success',
            title: e.detail.textresultado,
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
    });

    window.addEventListener('informacion', function (e) {
        Swal.fire({
            title: '<div style="font-size:18px;' +
                'font-weight:bold;">$title</div>'.replace('$title', e.detail.textresultado),
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
            width: 300,
            imageHeight: 20,

        });
    });


</script>