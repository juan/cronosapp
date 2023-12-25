@props(['id'=>$id,
        'cont'=>$cont,
        ])

<li class="relative  cursor-default select-none py-1 pl-4 pr-4
            odd:bg-gray-300 hover:!bg-primary-400" role="option" id="listbox-{{$id}}-{{$cont}}">
    {{$slot}}
</li>