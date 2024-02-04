<style>
    progress {
        border-radius: 7px;
        height: 10px;
        box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
    }

    progress::-webkit-progress-bar {
        background-color: #eee;
        border-radius: 7px;
    }

    progress::-webkit-progress-value {
        background-color: #478fd1;
        border-radius: 7px;
        box-shadow: 1px 1px 5px 3px rgba(208, 239, 232);
    }

</style>
@props([
'id_input',
'namefoto'=>false,
'labelname',
'wireid'=>$wireid
])

@php

    if($errors->has([$wireid])){
       $erroname = $wireid ;
    }else{
      $erroname =  substr($wireid,strpos($wireid,'.')+1,strlen($wireid)) ;
    }
@endphp

<div x-data="{photoName: null, photoPreview: @entangle('photostatus'), progress: 0 }"
     x-on:livewire-upload-start="photoName = true"
     x-on:livewire-upload-finish="photoName = false"
     x-on:livewire-upload-error="photoName = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
     class="col-span-2 ml-2 ">
    <!-- Photo File Input -->
    <!-- Photo File Input -->
    <input wire:model="{{$wireid}}" id="{{$wireid}}" name="{{$wireid}}"
           type="file" class="hidden" x-ref="photo" x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);
    ">
    <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
        {{$labelname}} <span class="text-red-600"> </span>
    </label>

    <div class="text-center">
        <!-- Current Profile Photo -->
        <div class="mt-2 ml-4" x-show="! photoPreview">
            @if(!$namefoto)
                <svg fill="none" viewBox="-1 -1 26 26" stroke-width="1.5" stroke="currentColor"
                     class="w-32 bg-blue-100 h-20 md:items-center rounded-full">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/>
                </svg>

            @else
                <img class="w-28 h-28 rounded-full" src="{{ Storage::url($namefoto) }}" alt="Default avatar">
            @endif
        </div>
        <!-- New Profile Photo Preview -->
        <div class="mt-1" x-show="$wire.photostatus" style="display: none;">
            @if(!$namefoto)
                <span
                        class="block w-28 h-28 h-28 rounded-full m-auto shadow"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'"
                        style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
            </span>
            @endif
        </div>
        <div class="mt-2" x-show="photoName">
            <progress class="rounded" max="100" x-bind:value="progress"></progress>
        </div>
        <button type="button"
                class="mt-3 hover:bg-gray-100 text-gray-800 font-semibold text-xs px-1.5 border border-gray-400 rounded"
                wire:click="cambiarPhoto"
                x-on:click.prevent="$refs.photo.click()">
            Buscar archivo
        </button>
        <button type="button"
                class="mt-3 hover:bg-gray-100 text-gray-800 font-semibold text-xs px-1.5 border border-gray-400 rounded"
                wire:click="resetImage">
            Cancelar
        </button>

        @error($erroname)
        <small class="block mt-1.5 invalid-feedback">{{  $message }}</small>
        @enderror
    </div>
    {{$slot}}

</div>