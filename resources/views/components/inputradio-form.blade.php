@props([
    'nameradio'=>false,
    'labelradio'=>false,
    'valueradio'=>false,
    'wirename'=>false
])
<label class="custom-radio">
    <input type="radio"
           wire:model="{{$wirename}}"
           name="{{$nameradio}}" value="{{$valueradio}}">
    <span></span>
    <span>{{$labelradio}}</span>
</label>