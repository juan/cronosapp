<div>
    <button
            x-on:click="openmenu=true"
            type="button"
            class="inline-flex w-full justify-center gap-x-1 rounded-md bg-white px-0.5 py-0.5
                                text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400
                                hover:bg-gray-50"
            id="menu-button" aria-expanded="true" aria-haspopup="true">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
    </button>
</div>
{{$slot}}