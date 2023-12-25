<div>
    <aside class="menu-bar menu-sticky">
        <div class="menu-items">
            <div class="menu-header hidden">
                <a href="{{ url('/') }}" class="flex items-center mx-8 mt-8">
                    <span class="avatar w-16 h-16">JP</span>
                    <div class="ltr:ml-4 rtl:mr-4 ltr:text-left rtl:text-right">
                        <h5>Juan P</h5>
                        <p class="mt-2">Editor</p>
                    </div>
                </a>
                <hr class="mx-8 my-4">
            </div>

            <a href="{{ url('/') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                <span class="icon la la-home"></span>
                <span class="title">Inicio</span>
            </a>
            <!-- Inicio de carga de opciones de menú -->

            @foreach($opcionmenu->whereNull('menu_id') as $datamenu)
                @if(is_null($datamenu->menu_id))
                    <a href="{{$datamenu->linkto}}" class="link"
                       data-target="[data-menu={{$datamenu->inicial	}}]" data-toggle="tooltip-menu"
                       data-tippy-content="{{$datamenu->namemenu}}">
                        <span class="icon {{$datamenu->bigicon}}"></span>
                        <span class="title text-xs">{{$datamenu->namemenu}}</span>
                    </a>
                @endif
            @endforeach

            <!-- Fin de carga de opciones de menú -->
        </div>

        <!-- Dashboard -->
        <!--
        <div class="menu-detail" data-menu="dashboard">
            <div class="menu-detail-wrapper">
                <a href="index.html">
                    <span class="la la-cube"></span>
                    Default
                </a>
                <a href="index.html">
                    <span class="la la-file-alt"></span>
                    Content
                </a>
                <a href="index.html">
                    <span class="la la-shopping-bag"></span>
                    Ecommerce
                </a>
            </div>
        </div>
        -->
        <?php
        $pasome = 0;
        $menus = $opcionmenu;
        $submenus = $opcionmenu;
        ?>
        @foreach($menus->whereNull('menu_id') as $datopcion)
            <div class="menu-detail" data-menu="{{$datopcion->inicial}}">
                <div class="menu-detail-wrapper">

                    @foreach($submenus->where('menu_id',$datopcion->id) as $opcion)
                        @if($opcion->titulo=='s')
                            <h6 class="uppercase">{{$opcion->namemenu}}</h6>
                        @else

                            <a href="{{ url($opcion->linkto) }}">
                                <span class="{{$opcion->bigicon}}"></span>
                                {{$opcion->namemenu}}
                            </a>

                        @endif
                    @endforeach

                </div>
            </div>
        @endforeach

        <!--
    <div class="menu-detail" data-menu="pages">
        <div class="menu-detail-wrapper">
            <h6 class="uppercase">Authentication</h6>
            <a href="{{ url('pages/auth/login') }}">
                <span class="la la-user"></span>
                Login
            </a>
            <a href="{{ url('pages/auth/forgot-password') }}">
                <span class="la la-user-lock"></span>
                Forgot Password
            </a>
            <a href="{{ url('pages/auth/register') }}">
                <span class="la la-user-plus"></span>
                Register
            </a>
            <hr>
            <h6 class="uppercase">Blog</h6>
            <a href="{{ url('pages/blog/list') }}">
                <span class="la la-list"></span>
                List
            </a>
            <a href="{{ url('pages/blog/list-card-rows') }}">
                <span class="la la-list"></span>
                List - Card Rows
            </a>
            <a href="{{ url('pages/blog/list-card-columns') }}">
                <span class="la la-list"></span>
                List - Card Columns
            </a>
            <a href="{{ url('pages/blog/add') }}">
                <span class="la la-layer-group"></span>
                Add Post
            </a>
            <hr>
            <h6 class="uppercase">Errors</h6>
            <a href="{{ url('pages/errors/403') }}" target="_blank">
                <span class="la la-exclamation-circle"></span>
                403 Error
            </a>
            <a href="{{ url('pages/errors/404') }}" target="_blank">
                <span class="la la-exclamation-circle"></span>
                404 Error
            </a>
            <a href="{{ url('pages/errors/500') }}" target="_blank">
                <span class="la la-exclamation-circle"></span>
                500 Error
            </a>
            <a href="{{ url('pages/errors/under-maintenance') }}" target="_blank">
                <span class="la la-exclamation-circle"></span>
                Under Maintenance
            </a>
            <hr>
            <a href="{{ url('pages/pricing') }}">
                <span class="la la-dollar"></span>
                Pricing
            </a>
            <a href="{{ url('pages/faqs-layout-1') }}">
                <span class="la la-question-circle"></span>
                FAQs - Layout 1
            </a>
            <a href="{{ url('pages/faqs-layout-2') }}">
                <span class="la la-question-circle"></span>
                FAQs - Layout 2
            </a>
            <a href="{{ url('pages/invoice') }}">
                <span class="la la-file-invoice-dollar"></span>
                Invoice
            </a>
        </div>
    </div>

     Applications
    <div class="menu-detail" data-menu="applications">
        <div class="menu-detail-wrapper">
            <a href="{{ url('applications/media-library') }}">
                <span class="la la-image"></span>
                Media Library
            </a>
            <a href="{{ url('applications/point-of-sale') }}">
                <span class="la la-shopping-bag"></span>
                Point Of Sale
            </a>
            <a href="{{ url('applications/to-do') }}">
                <span class="la la-check-circle"></span>
                To Do
            </a>
            <a href="{{ url('applications/chat') }}">
                <span class="la la-comment"></span>
                Chat
            </a>
        </div>
    </div>

    Menu
    <div class="menu-detail" data-menu="menu">
        <div class="menu-detail-wrapper">
            <a href="#no-link">
                <span class="la la-cube"></span>
                Default
            </a>
            <a href="#no-link">
                <span class="la la-file-alt"></span>
                Content
            </a>
            <a href="#no-link">
                <span class="la la-shopping-bag"></span>
                Ecommerce
            </a>
            <hr>
            <a href="#no-link">
                <span class="la la-layer-group"></span>
                Main Level
            </a>
            <a href="#no-link">
                <span class="la la-arrow-circle-right"></span>
                Grand Parent
            </a>
            <button class="collapse-header active" data-toggle="collapse" data-target="#menuGrandParentOpen">
                <span class="collapse-indicator la la-arrow-circle-down"></span>
                Grand Parent Open
            </button>
            <div id="menuGrandParentOpen" class="collapse open">
                <a href="#no-link">
                    <span class="la la-layer-group"></span>
                    Sub Level
                </a>
                <a href="#no-link">
                    <span class="la la-arrow-circle-right"></span>
                    Parent
                </a>
                <button class="collapse-header active" data-toggle="collapse" data-target="#menuParentOpen">
                    <span class="collapse-indicator la la-arrow-circle-down"></span>
                    Parent Open
                </button>
                <div id="menuParentOpen" class="collapse open">
                    <a href="#no-link">
                        <span class="la la-layer-group"></span>
                        Sub Level
                    </a>
                </div>
            </div>
            <hr>
            <h6 class="uppercase">Menu Types</h6>
            <a href="#no-link" data-toggle="menu-type" data-value="default">
                <span class="la la-hand-point-right"></span>
                Default
            </a>
            <a href="#no-link" data-toggle="menu-type" data-value="hidden">
                <span class="la la-hand-point-left"></span>
                Hidden
            </a>
            <a href="#no-link" data-toggle="menu-type" data-value="icon-only">
                <span class="la la-th-large"></span>
                Icons Only
            </a>
            <a href="#no-link" data-toggle="menu-type" data-value="wide">
                <span class="la la-arrows-alt-h"></span>
                Wide
            </a>
        </div>
    </div>-->
    </aside>
</div>