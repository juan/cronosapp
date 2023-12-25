<div
        x-data="{openmodal: true}"
        id="exampleModal" class="modal"
        data-animations="fadeInDown, fadeOutUp"
        @keydown.window.escape.stop.prevent="Livewire.emit('closeModal')"
>
    <div id="exampleModal" class="modal" data-animations="fadeInDown, fadeOutUp">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content w-full">
                <div class="modal-header h-2">
                    <h2 class="modal-title">Planes ({{$modelinsurance->name_insurance}})</h2>
                    <button class="close la la-times" wire:click.prevent="$emit('closeModal')"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 grid grid-cols-2 gap-x-6 gap-y-3 sm:grid-cols-12">
                        <div class="relative sm:col-span-8">
                            <x-boxtextinput label="Plan" idbox="insurancplan"
                                            wireid="insuraplans.name_insplan"
                                            maxlength="38" isrequired="yes"
                                            autofocus>
                            </x-boxtextinput>

                        </div>
                        <div class="relative sm:col-span-4"
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
                                                     x-on:click="$wire.set('insuraplans.state_id','{{$datastate->id}}');
                                                          $wire.set('namestate','{{$datastate->state_name}}')"
                                                     class="font-normal block truncate">{{$datastate->state_name}}
                                             </span>
                                    </x-liselect>
                                @endforeach
                            </x-select-input>
                        </div>
                    </div>
                    <div class="mt-2 mb-1.5 grid grid-cols-2 gap-x-6 gap-y-3 sm:grid-cols-12">
                        <div class="relative sm:col-span-12">
                            <x-textareainput
                                    label="Descripción" idbox="insurandescrip"
                                    wireid="insuraplans.descrip_insplan"
                                    maxlength="80"

                            />
                        </div>
                    </div>
                    @if(count($listInsurancePlans)>0)

                        <x-smalltable cabecera="Plan,Estatus,Descripción, Opciones"
                                      sortby="name_insplan,state_id" :apuntador="$apuntador">
                            @foreach($listInsurancePlans as $datainsuraplans)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$datainsuraplans->name_insplan}}</td>
                                    <td>
                                        <x-markatabla numstate="{{$datainsuraplans->state->id}}"
                                                      stringstate="{{$datainsuraplans->state->state_name}}">
                                        </x-markatabla>
                                    </td>
                                    <td>{{str()->limit($datainsuraplans->descrip_insplan,20,'. . .')}}</td>
                                    <td>
                                        <x-opcion-table editon="yes" deleteon="yes">
                                            <x-slot:funcioupdate>
                                                loadforEdit({{$datainsuraplans->id}})
                                            </x-slot:funcioupdate>
                                            <x-slot:funciodelete>

                                            </x-slot:funciodelete>
                                        </x-opcion-table>
                                    </td>
                                </tr>
                            @endforeach
                        </x-smalltable>
                        <br>
                        {{ $listInsurancePlans->links() }}
                    @else
                        <x-alert-form alert_type="alert_danger"
                                      alert_msgg="No existen registros"></x-alert-form>
                    @endif
                </div><!---End modal content!-->
                <div class="modal-footer">
                    <div class="flex ltr:ml-auto rtl:mr-auto">
                        <button
                                wire:click.stop.prevent="$emit('closeModal')"
                                class="btn btn_danger uppercase shadow-lg shadow-danger" type="button">
                            Cancelar
                        </button>
                        <button
                                wire:loading.attr="disabled"
                                wire:click.prevent="getDataInsuranPlan"

                                class="btn btn_success uppercase shadow-lg shadow-success ltr:ml-2 rtl:mr-2">
                                        <span
                                                wire:loading
                                                wire:target="getDataInsuranPlan"
                                                class="animate-bounce la la-save text-xl leading-none ltr:mr-2 rtl:ml-2">
                                        </span>

                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
