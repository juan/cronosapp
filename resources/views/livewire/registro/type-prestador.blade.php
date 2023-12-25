<div
        x-data="{openmodal: true}"
        id="exampleModal" class="modal"
        data-animations="fadeInDown, fadeOutUp"
        @keydown.window.escape.stop.prevent="Livewire.emit('closeModal')"
>
    <div class="modal-dialog max-w-2xl">
        <div class="modal-content">
            <div class="modal-header h-2">
                <h2 class="modal-title">Tipo Prestador</h2>
                <button class="close la la-times" wire:click.prevent="$emit('closeModal')"></button>
            </div>
            <div class="modal-body">
                <div class="mt-1 mb-1">
                    <x-search-box namefuncionbtn="typeprestadorCreate"
                                  isbotoncreatevisible="yes"
                                  isbotoncancelvisible="yes"
                                  wireinputname="name_type"
                                  numpage="{{$numpage}}">
                    </x-search-box>
                </div>
                <div class="flex flex-col">
                    @if(count($listTypePrestado)>0)
                        <x-smalltable cabecera="Tipo,Opciones"
                                      sortby="name_type" :apuntador="$apuntador">
                            @foreach($listTypePrestado as $datatyinsurance)
                                <tr>
                                    @if($loop->iteration !== $lineamodificar)
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$datatyinsurance->name_type}}</td>
                                        <td class="content text-left">
                                            <x-opcion-table editon="yes" deleteon="yes">
                                                <x-slot:funcioupdate>
                                                    loadTypeInsuranceEdit({{$datatyinsurance->id}},{{$loop->iteration}})
                                                </x-slot:funcioupdate>
                                                <x-slot:funciodelete>

                                                </x-slot:funciodelete>
                                            </x-opcion-table>
                                        </td>
                                    @else
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <x-texttableinput
                                                    wirename="typeprestador.name_type"
                                                    maxlength="28"></x-texttableinput>
                                        </td>
                                        <td>
                                            <x-opcion-table saveon="yes" cancelon="yes">
                                                <x-slot:funciosave>
                                                    typeinsuranceUpdate
                                                </x-slot:funciosave>

                                                <x-slot:funciocancel>
                                                    forCancelEdi
                                                </x-slot:funciocancel>
                                            </x-opcion-table>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </x-smalltable>
                    @else
                        <x-alert-form alert_type="alert_danger"
                                      alert_msgg="No existen registros"></x-alert-form>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <div class="flex ltr:ml-auto rtl:mr-auto">
                    <button
                            wire:click.stop.prevent="$emit('closeModal')"
                            class="btn btn_danger uppercase shadow-lg shadow-danger" type="button">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>