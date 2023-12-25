@props(
    [
      'label'=>$label,
      'idbox'=>  $idbox,
      'wireid' => $wireid,
      'isrequired'=>false,
      'isdisabled'=>false,
      'wireerror'=>false,
      'anchoselect'=>false,
    ]
)
@php
    $erroname =  substr($wireerror,strpos($wireerror,'.')+1,strlen($wireerror)) ;
    $colorinputerro = !empty($errors->get($erroname)) ? "is-invalid" : "";
    $colorriquired = !empty($isrequired) ? 'border-b-primary-600' : '';
    $isdisable = $isdisabled > 0 ? 'disabled' : '';
    $anchoselect = "w-$anchoselect";
@endphp
@if(!empty($label))
    <label
            class="label absolute block bg-input border border-border {{$colorriquired}}
                rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading "
            for="{{$idbox}}">{{$label}}</label>
@endif
<input
        wire:model="{{$wireid}}" id="{{$idbox}}" {{$isdisable}}
        {{$attributes->merge(['class'=>"form-control mt-2 pt-3.5 py-1
                               $colorinputerro", 'autocomplete'=>'off' ])}}>
<ul style="display: none" x-show.transition.opacity.duration.200="open" id="{{$wireid}}"
    class="absolute z-10 mt-1 max-h-40 overflow-auto rounded-md bg-white text-base
           shadow-lg ring-1 ring-offset-gray-800 ring-opacity-5 focus:outline-none sm:text-sm custom-select"

    tabindex="-1"
    role="listbox"
    aria-labelledby="listbox-label">

    {{$slot}}


</ul>

@error($erroname)
<small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
@enderror
