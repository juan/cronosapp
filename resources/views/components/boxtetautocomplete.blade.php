@props(
    [
      'label'=>$label,
      'idbox'=>  $idbox,
      'wireid' => $wireid,
      'isrequired'=>false,
      'erroname'=>false,
      'nfuncio' =>false
    ]
)
@php

    $colorriquired = !empty($isrequired) ? 'border-b-primary-600' : '';
    $colorinputerro = !empty($errors->get($erroname)) ? "is-invalid" : "";
@endphp
<label
        class="label absolute block bg-input border border-border {{$colorriquired}}
                            rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading"
        for="{{$idbox}}">{{$label}}
</label>
<input
        @focus="open = true; $wire.call('{{$nfuncio}}')"
        @keydown="open = true; $wire.call('{{$nfuncio}}')"
        @click.away="open = false"
        @keyup.escape.window="open = false"
        @keydown.tab="open = false"
        wire:keydown.debounce="{{$nfuncio}}"
        wire:model="{{$wireid}}"
        id="{{$idbox}}"
        {{$attributes->merge(['class'=>"form-control mt-2 pt-3.5 py-1 $colorinputerro", 'autocomplete'=>'off'])}}
>
@error($erroname)
<small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
@enderror

<ul x-show.transition.opacity.duration.200="open"
    class="absolute z-10 mt-1 max-h-40 w-full overflow-auto rounded-md bg-white text-base
           shadow-lg ring-1 ring-offset-gray-800 ring-opacity-5 focus:outline-none sm:text-sm custom-select"
    style="display: none"
    tabindex="-1"
    role="listbox"
    aria-labelledby="listbox-label">

    {{$slot}}


</ul>