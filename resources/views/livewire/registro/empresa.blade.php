<div>
    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Empresa"
                     opciones="Registro,Operativo,Empresa"
                     links="#no-link,#no-link,#no-link">
        </x-breadcrum>

    </section>

    <form
            action="#"
            id="getEmpresavalue"
            wire:submit.prevent="getEmpresavalue"
            method="POST"
    >
        @csrf

        <x-bodyform formtitle="Datos de empresa">
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-6">
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="Nombre" idbox="emprname"
                                    wireid="companydata.company_name"
                                    maxlength="38" isrequired="yes"
                                    isdisabled="{{$existe}}" autofocus>
                    </x-boxtextinput>

                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput label="CUIT" idbox="emprcuit"
                                    wireid="companydata.company_cuit" maxlength="15"
                                    isdisabled="{{$existe}}"
                                    isrequired="yes" x-data="" x-mask="999999999999999">
                    </x-boxtextinput>
                </div>
                <div class="relative sm:col-span-2">
                    <x-boxtextinput
                            label="Teléfono" idbox="emprtelf"
                            wireid="companydata.company_phone" maxlength="13" isrequired="yes"
                            x-data="" x-mask="9999999999999">
                    </x-boxtextinput>
                </div>
                <div class="relative sm:col-span-2">
                    <x-boxtextinput
                            label="Correo" idbox="emprcorreo"
                            wireid="companydata.company_email" maxlength="38" isrequired="yes">
                    </x-boxtextinput>
                </div>

                <div class="relative sm:col-span-2">
                    <x-boxtextinput
                            label="Web" idbox="emprweb"
                            wireid="companydata.company_web" maxlength="38">
                    </x-boxtextinput>
                </div>


                <div x-data="{ open: false }"
                     class="relative sm:col-span-3">
                    <x-boxtetautocomplete
                            label="Provincia" idbox="emprpro"
                            wireid="provincisearch" maxlength="38"
                            isrequired="yes" nfuncio="searchProvince"
                            x-on:change="$wire.set('citysearch','');
                                         $wire.set('companydata.city_id','');
                                         $wire.set('companydata.province_id','')"
                            erroname="province_id"
                    >
                        @if($provincearray)
                            @foreach($provincearray as $dataprov)
                                <x-liselect id="emprpro" cont="{{$loop->iteration}}">
                              <span
                                      x-on:click="$wire.set('provincisearch','{{$dataprov->province_name}}');
                                               $wire.set('companydata.province_id','{{$dataprov->id}}')"
                                      class="font-normal block truncate">{{$dataprov->province_name}}</span>
                                </x-liselect>
                            @endforeach
                        @endif
                    </x-boxtetautocomplete>
                </div>

                <div x-data="{ open: false }"
                     class="relative sm:col-span-3">

                    <x-boxtetautocomplete
                            label="Ciudad" idbox="emprciu"
                            wireid="citysearch" maxlength="38"
                            isrequired="yes" nfuncio="searchCity"
                            erroname="city_id"
                    >
                        @if($cityarray)
                            @foreach($cityarray as $datacity)
                                <x-liselect id="emprciu" cont="{{$loop->iteration}}">
                                   <span x-on:click="$wire.set('citysearch','{{$datacity->city_name}}');
                                                      $wire.set('companydata.city_id','{{$datacity->id}}')"
                                         class="font-normal block truncate">{{$datacity->city_name}}</span>
                                </x-liselect>
                            @endforeach
                        @endif
                    </x-boxtetautocomplete>
                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput
                            label="Dirección" idbox="emprdirec"
                            wireid="companydata.company_address" maxlength="30" isrequired="yes">
                    </x-boxtextinput>
                </div>
                <div class="relative sm:col-span-3">
                    <x-boxtextinput
                            label="Código Postal" idbox="emprcop"
                            wireid="companydata.company_zipcode" maxlength="6" isrequired="yes">
                    </x-boxtextinput>
                </div>

            </div>
            <h3 class="mt-1.5">Datos de contacto</h3>

            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-6">
                <div class="relative sm:col-span-2">
                    <x-boxtextinput
                            label="Nombre" idbox="emprnocontac"
                            wireid="companydata.company_person_contact"
                            isrequired="yes" maxlength="38">
                    </x-boxtextinput>

                </div>
                <div class="relative sm:col-span-2">
                    <x-boxtextinput
                            label="Teléfono" idbox="emprtelfconta"
                            wireid="companydata.company_person_phone"
                            isrequired="yes" maxlength="13"
                            x-data="" x-mask="9999999999999">
                    </x-boxtextinput>
                </div>
                <div class="relative sm:col-span-2">
                    <x-boxtextinput
                            label="Correo" idbox="emprcorreoconta"
                            wireid="companydata.company_person_email"
                            isrequired="yes" maxlength="38">
                    </x-boxtextinput>
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
                        wire:click.prevent="getEmpresavalue"
                        class="btn btn_success shadow-lg shadow-success  uppercase ltr:ml-2 rtl:mr-2">
                    <span
                            wire:loading
                            wire:target="getEmpresavalue"
                            class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                    </span>
                    Guardar
                </button>
            </div>
        </x-bodyform>
    </form>
</div>
