@props(
    [
      'label'=>$label,
      'idbox'=>  $idbox,
      'wireid' => $wireid,
      'isrequired'=>false,
      'isdisabled'=>false,
      'maximdia'=>false
    ]
)
@php
    $erroname =  substr($wireid,strpos($wireid,'.')+1,strlen($wireid)) ;
    $colorinputerro = !empty($errors->get($erroname)) ? "is-invalid" : "";
    $colorriquired = !empty($isrequired) ? 'border-b-primary-600' : '';
    $isdisable = $isdisabled > 0 ? 'disabled' : '';
    if($maximdia=='hoy'){
        $maximdia="new Date()";
    }else{
        $myear= date('Y');
        $myear= $myear+1;
        $maximdia="new Date($myear, 12, 31)";
    }
@endphp
<div
        x-data
        x-init="new Pikaday({ field: $refs.inputdate,
         format: 'DD/MM/YYYY',
         maxDate: {{$maximdia}},
         showTime: true,

         })"
>
    <label
            class="label absolute block bg-input border border-border {{$colorriquired}}
                rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading "
            for="{{$idbox}}">{{$label}}</label>
    <input
            type="text"
            x-ref="inputdate"
            x-mask="99/99/9999"
            wire:model.lazy="{{$wireid}}" id="{{$idbox}}" {{$isdisable}}
            {{$attributes->merge(['class'=>"form-control mt-2 pt-3 py-1
                                   $colorinputerro", 'autocomplete'=>'off' ])}}>
</div>
@error($erroname)
<small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
@enderror

@push('scriptsapp')
    <script src="{{ Vite::asset('node_modules/moment/moment.js') }}"></script>
    <script src="{{ Vite::asset('node_modules/pikaday/pikaday.js') }}"></script>
@endpush