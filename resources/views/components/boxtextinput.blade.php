@props(
    [
      'label'=>$label,
      'idbox'=>  $idbox,
      'wireid' => $wireid,
      'isrequired'=>false,
      'isdisabled'=>false
    ]
)
@php
    $erroname =  substr($wireid,strpos($wireid,'.')+1,strlen($wireid)) ;
    $colorinputerro = !empty($errors->get($erroname)) ? "is-invalid" : "";
    $colorriquired = !empty($isrequired) ? 'border-b-primary-600' : '';
    $isdisable = $isdisabled > 0 ? 'disabled' : '';

@endphp

<label
        class="label absolute block bg-input border border-border {{$colorriquired}}
                rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading "
        for="{{$idbox}}">{{$label}}</label>
<input wire:model.defer="{{$wireid}}" id="{{$idbox}}" {{$isdisable}}
        {{$attributes->merge(['class'=>"form-control mt-2 pt-3 py-1
                               $colorinputerro", 'autocomplete'=>'off' ])}}>

@error($erroname)
<small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
@enderror
