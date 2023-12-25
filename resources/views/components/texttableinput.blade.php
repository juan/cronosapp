@props(
    [

      'wirename' => $wirename,
      'isrequired'=>false,
    ]
)
@php
    $colorinputerro = !empty($errors->get($wirename)) ? "is-invalid" : "";

@endphp

<input
        wire:model="{{$wirename}}"
        {{$attributes->merge(['class'=>"form-control w-full py-1
                               $colorinputerro", 'autocomplete'=>'off' ])}} >

@error($wirename)
<small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
@enderror
