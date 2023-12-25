<div>


    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Prestadores"
                     opciones="Registro,Operativo,Prestadores"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="newInsurancePlan,newTypePrestador"
        >
        </x-breadcrum>
    </section>
    <form
            action="#"
            id="insuranceAccion"
            wire:submit.prevent="insuranceAccion"
            method="POST"
    >
        @csrf

        <x-bodyform formtitle="Listado prestadores">
            <x-slot:formopcionmenu>
                <div
                        class="relative inline-block text-left"
                        x-data="{menudrop:false}"
                        @click.window.outside="menudrop=false"
                        @keydown.window.escape.prevent.stop="menudrop=false"
                        @mouseover="menudrop=true"

                >
                    <div x-on:mouseleave="menudrop=false">
                        <div>
                            <button
                                    type="button"
                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-0.5 py-0.5 text-sm
                                font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 hover:bg-gray-50"
                                    id="menu-button" aria-expanded="true" aria-haspopup="true" data-tippy-arrow="true"
                                    data-tippy-placement="bottom">

                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                                </svg>
                            </button>
                        </div>

                        <div
                                x-show="menudrop"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                style="display: none"
                                class="absolute right-0 z-10 mt-1 w-40 origin-top-right divide-y divide-gray-100
                            rounded-md bg-primary-50 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div @click="menudrop=false"
                                 class="py-1" role="none"

                            >
                                @can('CREATE')
                                    <x-menuform.newandedit
                                            wire:click.prevent="newTypePrestador"
                                            namefuncion="openModal"
                                            nameopcion="Tipo Prestador"
                                    />
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot:formopcionmenu>
            @if(count($listInsurance)>0)

                <x-smalltable cabecera="Tipo,Nombre,Estatus,Teléfono, Correo, Planes, Opciones"
                              sortby="insurance_type_id,name_insurance,state_id" :apuntador="$apuntador">

                    @foreach($listInsurance as $datainsura)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$datainsura->insurance_type->name_type}}</td>
                            <td>{{$datainsura->name_insurance}}</td>
                            <td>
                                <x-markatabla numstate="{{$datainsura->state->id}}"
                                              stringstate="{{$datainsura->state->state_name}}">
                                </x-markatabla>

                            </td>
                            <td>{{$datainsura->telefono}}</td>
                            <td>{{$datainsura->correo}}</td>
                            <td>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center rounded-full
                                    {{$datainsura->insuranceplans_count <= 0 ? 'bg-fondonegativo' : 'bg-fondopositivo'}}
                                    px-2 py-1 text-xs font-body
                                    text-primary">{{$datainsura->insuranceplans_count}}</span>
                                    <x-menuform.opcionnewhamburge
                                            wire:click.prevent="newInsurancePlan('{{$datainsura->id}}')"
                                            namefuncion=""/>
                                </div>
                            </td>
                            <td>

                                <x-opcion-table editon="yes" deleteon="yes">
                                    <x-slot:funcioupdate>
                                        loadforEdit({{$datainsura->id}})
                                    </x-slot:funcioupdate>
                                    <x-slot:funciodelete>

                                    </x-slot:funciodelete>
                                </x-opcion-table>
                            </td>
                        </tr>
                    @endforeach

                </x-smalltable>
                <br>
                {{ $listInsurance->links() }}
            @else
                <x-alert-form alert_type="alert_danger"
                              alert_msgg="No existen registros"></x-alert-form>
            @endif

            @can('CREATE')
                <div
                        x-data="{
                           showWindow:@entangle('openWindow'),
                           closeWindow(){

                           }
                        }"
                        @keydown.window.escape.prevent.stop="showWindow =false"
                >
                    <div data-dial-init class="fixed right-6 bottom-6 group">
                        <div class="flex flex-col items-center  mb-4 space-y-2">
                            <button type="button"
                                    x-on:click="showWindow =true"
                                    class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900
                            bg-primary-200 rounded-full border border-gray-200 dark:border-gray-600 shadow-sm
                            dark:hover:text-white dark:text-gray-400 hover:bg-primary-100 dark:bg-gray-700
                            dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="blue" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                            </button>
                        </div>
                    </div>


                    <div
                            id="exampleModalAside" class="modal modal_aside"
                            x-show="showWindow" style="display: none"
                    >
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header" style="height: 2px">
                                    <h3 class="modal-title">Nuevo Prestador</h3>
                                </div>

                                <div class="modal-body space-y-2 w-80">

                                    <div
                                            class="relative w-full"
                                            x-data="{
                                                   open:false,
                                                   cerrar(){
                                                      this.open = false
                                                   },
                                                   abrir(){
                                                     this.open = true
                                                   }
                                                }"
                                            @keydown.escape.prevent.stop="cerrar()"
                                    >
                                        <x-select-input
                                                @click="abrir()"
                                                @click.outside="cerrar()"
                                                @keydown.tab="cerrar()"
                                                label="Tipo" idbox="insuratype"
                                                wireid="tipoprestador"
                                                wireerror="obrasocial.insurance_type_id"
                                                isrequired="yes">
                                            @foreach($lisprestadores as $datatypeinsurance)
                                                <x-liselect
                                                        style="display: none"
                                                        x-show="open"
                                                        id="types"
                                                        cont="{{$loop->iteration}}">
                                                 <span
                                                         x-on:click="$wire.set('obrasocial.insurance_type_id','{{$datatypeinsurance->id}}');
                                                          $wire.set('tipoprestador','{{$datatypeinsurance->name_type}}')"
                                                         class="font-normal block truncate">{{$datatypeinsurance->name_type}}
                                                 </span>
                                                </x-liselect>
                                            @endforeach
                                        </x-select-input>


                                    </div>

                                    <div class="relative">
                                        <x-boxtextinput label="Nombre" idbox="insuraname"
                                                        wireid="obrasocial.name_insurance"
                                                        maxlength="45" isrequired="yes"
                                        >
                                        </x-boxtextinput>
                                    </div>
                                    <div
                                            class="relative"
                                            x-data="{
                                       open:false,
                                       cerrar(){
                                          this.open = false
                                       },
                                       abrir(){
                                         this.open = true
                                       }
                                    }"
                                            @keydown.escape.prevent.stop="cerrar()"
                                    >
                                        <x-select-input
                                                @click="abrir()"
                                                @focus="abrir()"
                                                @click.outside="cerrar()"
                                                @keydown.tab="cerrar()"
                                                label="Estatus" idbox="insurastatu"
                                                wireid="namestate"
                                                wireerror="obrasocial.state_id"
                                                isrequired="yes">
                                            @foreach($liststatus as $datastate)
                                                <x-liselect
                                                        style="display: none"
                                                        x-show="open"
                                                        id="status"
                                                        cont="{{$loop->iteration}}">
                                         <span
                                                 x-on:click="$wire.set('obrasocial.state_id','{{$datastate->id}}');
                                                      $wire.set('namestate','{{$datastate->state_name}}')"
                                                 class="font-normal block truncate">{{$datastate->state_name}}
                                         </span>
                                                </x-liselect>
                                            @endforeach
                                        </x-select-input>
                                    </div>
                                    <div class="relative">
                                        <x-boxtextinput
                                                label="Teléfono" idbox="emprtelf"
                                                wireid="obrasocial.telefono" maxlength="13"
                                                x-data="" x-mask="9999999999999">
                                        </x-boxtextinput>
                                    </div>
                                    <div class="relative">
                                        <x-boxtextinput
                                                label="Correo" idbox="emprcorreo"
                                                wireid="obrasocial.correo" maxlength="30">
                                        </x-boxtextinput>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                            x-on:click="showWindow = false"
                                            wire:click.prevent="resetForm"
                                            class="btn btn_danger uppercase shadow-lg shadow-danger" type="button">
                                        Cancelar
                                    </button>
                                    <button
                                            wire:loading.attr="disabled"
                                            wire:click.prevent="insuranceAccion"

                                            class="btn btn_success uppercase shadow-lg shadow-success ltr:ml-2 rtl:mr-2">
                                        <span
                                                wire:loading
                                                wire:target="insuranceAccion"
                                                class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                                        </span>

                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </x-bodyform>
    </form>
</div>
