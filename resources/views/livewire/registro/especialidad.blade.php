<div>
    <section class="-mt-6 breadcrumb mb-1">
        <x-breadcrum titulo="Especialidades"
                     opciones="Registro,Operativo,Especialidades"
                     links="#no-link,#no-link,#no-link"
                     opcionesloadin="especialityCreate"
        >
        </x-breadcrum>
    </section>
    <form
            action="#"
            id="getEmpresavalue"
            wire:submit.prevent="especialityCreate"
            method="POST"
    >
        @csrf
        <x-bodyform formtitle="Listado de especialidades">
            <x-slot:formopcionmenu></x-slot:formopcionmenu>
            <div class="mt-1 mb-1">
                <x-search-box namefuncionbtn="especialityCreate"
                              isbotoncreatevisible="yes"
                              isbotoncancelvisible="yes"
                              wireinputname="name_speciality"
                              numpage="{{$numpage}}">
                </x-search-box>
            </div>

            <div class="flex flex-col ">

                @if(count($especialidades)>0)
                    <x-smalltable cabecera="Especialidad,Estatus,Opciones"
                                  sortby="name_speciality,state_id" :apuntador="$apuntador">
                        @foreach($especialidades as $datespe)
                            <tr>
                                @if($updateline!== $loop->iteration)
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$datespe->name_speciality}}</td>
                                    <td>
                                        <x-markatabla
                                                numstate="{{$datespe->state->id}}"
                                                stringstate="{{$datespe->state->state_name}}">
                                        </x-markatabla>
                                    </td>
                                    <td>
                                        <x-opcion-table editon="yes" deleteon="yes">
                                            <x-slot:funcioupdate>
                                                forUpdateEspecialidad({{$datespe->id}},{{$loop->iteration}})
                                            </x-slot:funcioupdate>
                                            <x-slot:funciodelete>
                                                forDeleteEspecialidad({{$datespe->id}})
                                            </x-slot:funciodelete>
                                        </x-opcion-table>
                                    </td>
                                @else
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <x-texttableinput
                                                wirename="specialties.name_speciality"
                                                maxlength="32"></x-texttableinput>
                                    </td>
                                    <td>
                                        <div class="space-y-4 sm:flex sm:items-center sm:space-x-2 sm:space-y-0">
                                            @if($states)
                                                @foreach($states as $datastate)
                                                    <div class="flex items-center">
                                                        <x-inputradio-form nameradio="specialidad"
                                                                           wirename="specialties.state_id"
                                                                           labelradio="{{$datastate->state_name}}"
                                                                           valueradio="{{$datastate->id}}">

                                                        </x-inputradio-form>
                                                    </div>

                                                @endforeach

                                            @endif

                                        </div>
                                    </td>
                                    <td>
                                        <x-opcion-table saveon="yes" cancelon="yes">
                                            <x-slot:funciosave>
                                                especialidadUpdate
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
                    <br>
                    {{ $especialidades->links() }}
                @else
                    <x-alert-form alert_type="alert_danger"
                                  alert_msgg="No existen registros"></x-alert-form>
                @endif


            </div>
        </x-bodyform>
    </form>
</div>
