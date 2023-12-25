@props([
    'viewon'=>false,
    'editon'=>false,
    'deleteon'=>false,
    'saveon'=>false,
    'cancelon'=>false,
    'funciowiew'=>false,
    'funcioupdate'=>false,
    'funciodelete'=>false,
    'funciosave'=>false,
    'funciocancel'=>false
])

<div class="flex item-center justify-left">
    @if($viewon)
        @can('VIEW')
            <div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
                <svg
                        type="button"
                        wire:click.prevent="{{$funciowiew}}"
                        wire:target="{{$funciowiew}}"
                        fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
        @endcan
    @endif
    @if($editon)
        @can('UPDATE')

            <div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
                <svg
                        type="button"
                        wire:click.prevent="{{$funcioupdate}}"
                        wire:target="{{$funcioupdate}}"
                        fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
            </div>
        @endcan
    @endif
    @if($deleteon)
        @can('DELETE')
            <div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110 ">
                <svg
                        type="button"
                        wire:click.prevent="{{$funciodelete}}"
                        wire:target="{{$funciodelete}}"
                        fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
        @endcan
    @endif
    @if($saveon)
        @can('CREATE')
            <div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
                <svg
                        type="button"
                        wire:click.prevent="{{$funciosave}}"
                        wire:target="{{$funciosave}}"
                        fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" class="humbleicons hi-save">
                    <path stroke="currentColor"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7.828a2 2 0 00-.586-1.414l-1.828-1.828A2 2 0 0016.172 4H15M8 4v4a1 1 0 001 1h5a1 1 0 001-1V4M8 4h7M7 17v-3a1 1 0 011-1h8a1 1 0 011 1v3"/>
                </svg>
            </div>
        @endcan
    @endif
    @if($cancelon)
        <div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
            <svg
                    type="button"
                    wire:click.prevent="{{$funciocancel}}"
                    wire:target="{{$funciocancel}}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-times">
                <g stroke="currentColor" stroke-linecap="round" stroke-width="2">
                    <path d="M6 18L18 6M18 18L6 6"/>
                </g>
            </svg>
        </div>

    @endif
</div>

