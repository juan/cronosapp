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
<div

        x-data="{
              passtyep:'password',
              passwordshow(){
                    if(this.passtyep=='password'){
                      this.passtyep = 'text'
                    }else{
                      this.passtyep = 'password'
                    }
              }
        }"
>
    <label
            class="label absolute block bg-input border border-border {{$colorriquired}}
                    rounded top-0 ltr:ml-4 rtl:mr-4 px-2 font-heading "
            for="{{$idbox}}">{{$label}}</label>
    <input wire:model.defer="{{$wireid}}" id="{{$idbox}}" {{$isdisable}} x-bind:type="passtyep"
            {{$attributes->merge(['class'=>"form-control mt-2 pt-3 py-1
                                   $colorinputerro", 'autocomplete'=>'off'])}}>
    <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center">
        <button type="button"
                @click="passwordshow()"
                class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                data-toggle="password-visibility"></button>
    </div>
</div>
@error($erroname)
<small class="block mt-1.5 invalid-feedback">{{ $message }}</small>
@enderror
