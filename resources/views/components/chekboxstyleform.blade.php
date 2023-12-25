@props(
    [
      'label'=>false,
      'idbox'=>  $idbox,
      'wireid' => $wireid,
      'isrequired'=>false,
      'isdisabled'=>false,
      'valcaja' =>false
    ]
)
<label class="switch">

    <input wire:model.defer="{{$wireid}}" type="checkbox" id="{{$idbox}}" value="{{$valcaja}}" {{$isdisabled}}>
    <span></span>
    <span>{{$label}}</span>
</label>
