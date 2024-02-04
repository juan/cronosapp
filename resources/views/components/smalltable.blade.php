@props(
    [
      'cabecera'=>false,
      'sortby'=>false,
      'apuntador'=>false
    ]
)

@php
    $cabecera = explode(',',$cabecera);
    if($sortby){
     $sortby = explode(',',$sortby);
     $colorheader='';
    }
    $iconsor='';
@endphp
<div class="flex flex-col ">
    <div class="card p-2 bg-fondotabla">

        <table
                x-data="{}"
                {{-- x-on:click.away.prevent.stop="$wire.set('apuntador','')"--}}
                class="table-xs table_striped w-full mt-3 ">
            <thead>
            <tr>
                <th class="ltr:text-left rtl:text-right uppercase">#</th>
                @foreach($cabecera as $datac)

                    <th
                            @if($sortby)
                                @if(isset($sortby[$loop->index]))
                                    wire:click="orderColum('{{$sortby[$loop->index]}}','{{$sortby[$loop->index]}}')" ;
                            wire:target="orderColum"
                            x-on:click="$wire.set('apuntador','{{$loop->index}}')"
                            @php
                                $iconsor ='s';
                            @endphp
                            @else
                                @php
                                    $iconsor ='';
                                @endphp
                            @endif
                            @if($apuntador==$loop->index)
                                @php
                                    $colorheader='text-primary-600';
                                @endphp
                            @else
                                @php
                                    $colorheader='' ;
                                @endphp
                            @endif
                            class="ltr:text-left {{$colorheader}} rtl:text-right uppercase"
                            @endif
                    >
                        <div
                                class="flex items-center {{$iconsor=='s' ? 'cursor-pointer' : null}}">
                            {{$datac}}
                            @if($iconsor=='s')
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                </svg>
                            @endif
                        </div>
                    </th>

                @endforeach
            </tr>
            </thead>
            <tbody>
            {{$slot}}
            </tbody>
        </table>
    </div>
</div>
