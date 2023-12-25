@props(
    [
      'label'=>$label,
      'idbox'=>  $idbox,
      'wireid' => $wireid,
      'isrequired'=>false,
      'isdisabled'=>false,
      'valcaja' =>false
    ]
)
@php
    $erroname =  substr($wireid,strpos($wireid,'.')+1,strlen($wireid)) ;
    $colorinputerro = !empty($errors->get($erroname)) ? "is-invalid" : "";
    $colorriquired = !empty($isrequired) ? 'border-b-primary-600' : '';
    $isdisable = $isdisabled > 0 ? 'disabled' : '';

@endphp


<input wire:model.defer="{{$wireid}}" type="checkbox" {{$isdisabled}} value="{{$valcaja}}">
<span></span>
<span>{{$label}}</span>
@if($isrequired)
    @error($erroname)
    <small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
    @enderror
@endif
