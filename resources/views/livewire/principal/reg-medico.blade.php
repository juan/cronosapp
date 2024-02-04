<div>
    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Médico"
                     opciones="Registro,Principal,Médico"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="getDoctor,listDoctor"
        >
        </x-breadcrum>
    </section>
    <form wire:submit.prevent="getDoctor">
        @csrf
        <x-bodyform formtitle="Registro médico">
            <x-opcionsbladeform namefunction="listDoctor"></x-opcionsbladeform>
            <div class="relative">
                <div
                        wire:click.prevent="listDoctor"
                        wire:target="listDoctor"
                        class="p-2 w-12 h-12 absolute right-0 -top-20 flex items-center
                        justify-center bg-fondotabla shadow-lg rounded-lg
                        border border-primary-400 cursor-pointer">
                    <svg type="button"

                         fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>

                </div>
            </div>
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-2 mb-2 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-9">
                <div class="flex sm:col-span-4 gap-x-1">
                    <div class="relative  sm:col-span-1 w-36">
                        <x-input_select_form
                                label="Profesión" idbox="docmencion"
                                wireid="datadoctor.skill_id" autofocus isdisabled="{{$isdisabled}}"
                        >
                            <option disabled selected value></option>
                            @foreach($listSkills as $datskill)
                                <option value="{{$datskill->id}}">{{$datskill->name_skill}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>
                    @php
                        if(count($lismedicos)>=1){
                            $open='true';

                        }else{

                            $open='false';

                        }
                    @endphp
                    <div class="relative w-full"
                         x-data="{
                                       open:{{$open}},
                                       cerrar(){
                                          this.open = false


                                       },
                                       abrir(){
                                         this.open = true
                                       },
                                       close(){
                                        $wire.limpiarListMedico()
                                       }
                                    }"
                         @keydown.escape.prevent.stop="close()"
                      
                    >
                        <x-boxtextinput label="Nombre" idbox="docname"
                                        wire:keyup="findRoleMedic"
                                        wireid="datauser.name_doc"
                                        maxlength="15" isrequired="yes"
                                        maxlength="42" isdisabled="{{$isdisabled}}"
                        >
                        </x-boxtextinput>
                        @if(count($lismedicos)>=1)

                            <ul
                                    x-show="open"
                                    class="absolute z-10 mt-1 max-h-40 w-full overflow-auto rounded-md
                                bg-gray-100 py-0 text-base shadow-lg ring-1
                                   ring-info focus:outline-none sm:text-sm "
                                    id="options" role="listbox">
                                @foreach($lismedicos as $datuser)
                                    <li class="relative cursor-default select-none py-1 pl-3 pr-9 text-gray-900 hover:bg-gray-200"
                                        id="option-{{$loop->iteration}}"
                                        role="option" tabindex="-1">
                                        <span class="block truncate"
                                              @click="cerrar()"
                                              wire:click="loadTempInfo('{{$datuser->id}}')">
                                            {{"$datuser->name $datuser->lastname"}}
                                        </span>
                                    </li>
                                @endforeach

                            </ul>

                        @endif
                    </div>
                </div>
                <div class="relative sm:col-span-2">

                    <x-boxtextinput label="Apellido" idbox="doclastna"
                                    wireid="datauser.lastname_doc"
                                    maxlength="42" isrequired="yes" isdisabled="{{$isdisabled}}"
                    >
                    </x-boxtextinput>

                </div>
                <div class="flex sm:col-span-3 gap-x-1">
                    <div class="relative  sm:col-span-1 w-24">
                        <x-input_select_form
                                label="Tipo" idbox="tipdocmatri"
                                wireid="datadoctor.type_id" isdisabled="{{$isdisabled}}"

                        >
                            @foreach($ListTypes as $datatype)
                                <option value="{{$datatype->id}}">{{$datatype->matricula_type}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>

                    <div class="relative w-full">
                        <x-boxtextinput label="Matrícula" idbox="docmatri"
                                        wireid="datadoctor.num_matricula"
                                        maxlength="15" isrequired="yes"
                                        x-data="" x-mask="999999999999999"
                                        isdisabled="{{$isdisabled}}"
                        >
                        </x-boxtextinput>
                    </div>
                </div>
                <div class="relative sm:col-span-2">
                    <x-input_select_form
                            label="Especialidad" idbox="docspeciali"
                            wireid="datadoctor.specialtie_id"
                            icondpd="y" isdisabled="{{$isdisabled}}"
                    >
                        <option disabled selected value></option>
                        @foreach($listSpecialities as $dataspeciali)
                            <option value="{{$dataspeciali->id}}">{{$dataspeciali->name_speciality}}</option>
                        @endforeach

                    </x-input_select_form>
                </div>
                <div class="flex sm:col-span-4 gap-x-1">
                    <div class="relative  w-full">
                        <x-boxtextinput label="Correo" idbox="doccorreo"
                                        wireid="datauser.email_doc"
                                        maxlength="30" isdisabled="{{$isdisabled}}"

                        ></x-boxtextinput>
                    </div>

                    <div class="relative sm:col-span-2 w-72">
                        <x-boxtextinput label="Teléfono" idbox="docphone"
                                        wireid="datauser.phone_doc"
                                        maxlength="13" isdisabled="{{$isdisabled}}"
                                        x-data="" x-mask="9999999999999"

                        ></x-boxtextinput>
                    </div>
                </div>

                <div class="relative sm:col-span-3">
                    <x-input_select_form
                            label="Estatus" idbox="docstatus"
                            wireid="datadoctor.state_id"
                            icondpd="y" isdisabled="{{$isdisabled}}"
                    >
                        <option disabled selected value></option>
                        @foreach($liststatus as $datastatus)
                            <option value="{{$datastatus->id}}">{{$datastatus->state_name}}</option>
                        @endforeach

                    </x-input_select_form>
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
                        wire:click.prevent="getDoctor"
                        class="btn btn_success shadow-lg shadow-success  uppercase ltr:ml-2 rtl:mr-2">
                    <span
                            wire:loading
                            wire:target="getDoctor"
                            class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                    </span>
                    Guardar
                </button>
            </div>
        </x-bodyform>
    </form>
</div>
