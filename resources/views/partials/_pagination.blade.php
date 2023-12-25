<!-- Pagination -->
<div class="card lg:flex">

    <div class="flex relative mt-1 items-center">
        <label
                class="label absolute block bg-input top-0 ltr:ml-3 rtl:mr-3 px-1 rounded font-heading uppercase"
                for="input-1">Buscar.</label>
        <input id="input-1" autofocus class="form-control
        w-96 mt-1 pt-4 py-0.5 ml-1" placeholder="Ingrese dato de busquedad...">

        <button
                wire:loading.attr="disabled"
                wire:click.prevent="{{$funcion}}"
                class="btn btn-icon btn-icon_small btn_primary mt-1 ml-1">
            <span class="la la-plus"></span>
        </button>


    </div>


    <div class="flex items-center ltr:ml-auto rtl:mr-auto p-3 border-t lg:border-t-0 border-divider">
        Displaying 1-5 of 100 items
    </div>
    <div class="flex items-center gap-2 p-3 border-t lg:border-t-0 lg:ltr:border-l lg:rtl:border-r border-divider">
        <span>Mostrar</span>
        <div class="dropdown">
            <button class="btn btn_outlined btn_secondary" data-toggle="dropdown-menu">
                20
                <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
            </button>
            <div class="dropdown-menu">
                <a href="#no-link">10</a>
                <a href="#no-link">20</a>
                <a href="#no-link">45</a>
                <a href="#no-link">60</a>
            </div>
        </div>
        <span>items</span>
    </div>
</div>