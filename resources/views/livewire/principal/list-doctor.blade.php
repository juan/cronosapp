<div
        x-data="{openmodal: true}"
        id="exampleModal" class="modal"
        data-animations="fadeInDown, fadeOutUp"
        @keydown.window.escape.stop.prevent="Livewire.emit('closeModal')"
>
    <div class="modal-dialog  w-9/12">
        <div class="modal-content w-full">
            <div class="modal-header w-full h-2">
                <h2 class="modal-title">Listado médicos</h2>
                <button class="close la la-times" wire:click.prevent="$emit('closeModal')"></button>
                <div class="relative">
                    <div
                            wire:click.prevent="printListDoctor"
                            class="p-2 w-9 h-9 absolute right-10 -top-0 flex items-center
                        justify-center bg-fondotabla shadow-lg rounded-lg
                        border border-primary-400 cursor-pointer">
                        <svg type="button"

                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34
                                  18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                        </svg>
                    </div>
                    <div
                            wire:click.prevent="downloadlistDoctor"
                            class="p-2 w-9 h-9 absolute right-20 -top-0 flex items-center
                        justify-center bg-fondotabla shadow-lg rounded-lg
                        border border-primary-400 cursor-pointer">
                        <svg type="button"

                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="modal-body ">
                <div class="mt-1 mb-1 ">
                    <x-menuform.search-box-modal namefuncionbtn=""
                                                 wireinputname="valuesearch"
                                                 numpage="{{$numpage}}"
                                                 :opcionSort="$opcionSort"
                    >

                    </x-menuform.search-box-modal>
                </div>
                <div class="flex flex-col w-full">
                    @if(count($listDoctors)>0)
                        <x-smalltable cabecera="Mención,Nombre,Apellido,Especialidad,Estatus,Opciones"
                                      sortby="skill_id,name_doc,lastname_doc,specialtie_id" :apuntador="$apuntador">
                            @foreach($listDoctors as $datadoct)
                                <tr>

                                    <td class="p-1">{{$loop->iteration}}</td>
                                    <td class="p-1">{{$datadoct->skill->name_skill}}</td>
                                    <td>{{$datadoct->name_doc}}</td>
                                    <td>{{$datadoct->lastname_doc}}</td>
                                    <td>{{$datadoct->specialtie->name_speciality}}</td>
                                    <td>
                                        <x-markatabla numstate="{{$datadoct->state->id}}"
                                                      stringstate="{{$datadoct->state->state_name}}">
                                        </x-markatabla>

                                    </td>

                                    <td class="px-4">
                                        <x-opcion-table editon="yes" viewon="yes">
                                            <x-slot:funciowiew>
                                                loadDoctorInfo({{$datadoct->id}},'view')
                                            </x-slot:funciowiew>
                                            <x-slot:funcioupdate>
                                                loadDoctorInfo({{$datadoct->id}},'update')
                                            </x-slot:funcioupdate>

                                        </x-opcion-table>
                                    </td>
                                </tr>
                            @endforeach
                        </x-smalltable>

                        <br>
                        {{ $listDoctors->links() }}
                    @else
                        <x-alert-form alert_type="alert_danger"
                                      alert_msgg="No existen registros"></x-alert-form>
                    @endif
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
