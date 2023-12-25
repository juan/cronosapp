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
                        wire:click.prevent=""
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
                                label="Mención" idbox="docmencion"
                                wireid="datadoctor.skill_id" autofocus isdisabled="{{$isdisabled}}"
                        >
                            <option disabled selected value></option>
                            @foreach($listSkills as $datskill)
                                <option value="{{$datskill->id}}">{{$datskill->name_skill}}</option>
                            @endforeach
                        </x-input_select_form>
                    </div>

                    <div class="relative w-full">
                        <x-boxtextinput label="Nombre" idbox="docname"
                                        wireid="datadoctor.name"
                                        maxlength="15" isrequired="yes"
                                        maxlength="42" isdisabled="{{$isdisabled}}"
                        >
                        </x-boxtextinput>
                    </div>
                </div>
                <div class="relative sm:col-span-2">

                    <x-boxtextinput label="Apellido" idbox="doclastna"
                                    wireid="datadoctor.lastname"
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
                                        wireid="datadoctor.email"
                                        maxlength="30" isdisabled="{{$isdisabled}}"

                        ></x-boxtextinput>
                    </div>

                    <div class="relative sm:col-span-2 w-72">
                        <x-boxtextinput label="Teléfono" idbox="docphone"
                                        wireid="datadoctor.phone"
                                        maxlength="13" isdisabled="{{$isdisabled}}"
                                        x-data="" x-mask="9999999999999"

                        ></x-boxtextinput>
                    </div>
                </div>

                <div class="relative sm:col-span-2">
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
                <div class="relative sm:col-span-1 ">
                    <label class="custom-checkbox mt-4">
                        <x-input_check_form label="Iterno" idbox="docinterno"
                                            wireid="datadoctor.interno_doc"
                                            isdisabled="{{$isdisabled}}">

                        </x-input_check_form>
                    </label>
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
