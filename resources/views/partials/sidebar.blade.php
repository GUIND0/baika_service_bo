<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder "> {{--{{ config('app.name') }}--}}
                <img src="{{asset('files/images/logo.png')}}" alt=""
                     class="col-md-3 rounded-circle" style="  position: relative !important;width: 170px; height:
                 100px;">
            </span>
        </a>


        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-3">
        <!-- Dashboard -->
        <li class="menu-item {{ (request()->routeIs('dashboard.index')) ? 'active' : '' }}">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons fa fa-tachometer text-primary"></i>
                <div data-i18n="Analytics">Tableau de bord</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->routeIs('sinistre.index')) ? 'active' : '' }}">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons fa fa-free-code-camp text-primary"></i>
                <div data-i18n="Analytics">Reservation</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->routeIs('actualite.list') || request()->routeIs('actualite.create_or_update')) ? 'active' : '' }}">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icon fa fa-globe text-primary"></i>
                <div data-i18n="Analytics">Chauffeur</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->routeIs('conseil.list')  || request()->routeIs('conseil.create_or_update')) ? 'active' : '' }}">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle text-primary"></i>
                <div data-i18n="Analytics">Location de voiture</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->routeIs('alerte.list')  || request()->routeIs('alerte.create_or_update')) ? 'active' : '' }}">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bell-plus text-primary"></i>
                <div data-i18n="Analytics">Taxi-moto</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->routeIs('service.index')  || request()->routeIs('service.*')) ? 'active' : '' }}">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icon bx bx-map text-primary" ></i>
                <div data-i18n="Analytics">Tourisme</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->routeIs('region.index')) || (request()->routeIs('numero-utile.index')) || (request()->routeIs('texte.index')) || (request()->routeIs('numero-utile.index')) ||  (request()->routeIs('info_meteo.list')) || (request()->routeIs('servicetype.*')) || (request()->routeIs('info_meteo.create_or_update')) || (request()->routeIs('temperature.index')) || (request()->routeIs('localite.*'))  ? 'active open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa fa-list text-primary"></i>
                <div data-i18n="Account Settings">Autres</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item {{ (request()->routeIs('numero-utile.index')) ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Compagnie</div>
                    </a>
                </li>

                <li class="menu-item {{ (request()->routeIs('texte.index')) ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <div data-i18n="Text Divider">Axes</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (request()->routeIs('user.*')) || (request()->routeIs('role.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog text-primary"></i>
                <div data-i18n="Analytics">Paramètres</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('user.*')) ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Utilisateurs</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('role.*')) ? 'active' : '' }}">
                    <a href="{{ route('role.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Roles</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
