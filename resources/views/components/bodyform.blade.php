@props(['formtitle'=>$formtitle])
<div class="card p-5 shadow-lg border-t-4 border-primary-300">
    <div class="flex items-center">
        <div class="w-full">
            <h3>{{$formtitle}}</h3>
        </div>
        {{ $formopcionmenu }}
        
    </div>
    {{$slot}}
</div>
