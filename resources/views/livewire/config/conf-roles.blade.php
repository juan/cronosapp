<div>
    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Roles"
                     opciones="Configuración,Sistema,Roles"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin=""
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

        <x-bodyform formtitle="Listado roles">
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            @if(count($listRoles)>0)

                <x-smalltable cabecera="Nombre,Estatus,Opciones"
                              sortby="name_role,state_id" :apuntador="$apuntador">

                    @foreach($listRoles as $datarole)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$datarole->name_role}}</td>

                            <td>
                                <x-markatabla numstate="{{$datarole->state->id}}"
                                              stringstate="{{$datarole->state->state_name}}">
                                </x-markatabla>

                            </td>
                            <td>

                                <x-opcion-table editon="yes" deleteon="yes">
                                    <x-slot:funcioupdate>
                                        loadforEdit({{$datarole->id}})
                                    </x-slot:funcioupdate>
                                    <x-slot:funciodelete>

                                    </x-slot:funciodelete>
                                </x-opcion-table>
                            </td>
                        </tr>
                    @endforeach

                </x-smalltable>
                <br>
                {{ $listRoles->links() }}
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
                                    <h3 class="modal-title">Nuevo Role</h3>
                                </div>

                                <div class="modal-body space-y-2 w-80 h-full">


                                    <div class="relative">
                                        <x-boxtextinput label="Rol" idbox="nomrole"
                                                        wireid="roleinfo.name_role"
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
                                                 x-on:click="$wire.set('roleinfo.state_id','{{$datastate->id}}');
                                                      $wire.set('namestate','{{$datastate->state_name}}')"
                                                 class="font-normal block truncate">{{$datastate->state_name}}
                                         </span>
                                                </x-liselect>
                                            @endforeach
                                        </x-select-input>
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
                                            wire:click.prevent="rolesAccion"

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
