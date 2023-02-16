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
            <a href="{{ route('dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa fa-tachometer text-dark"></i>
                <div data-i18n="Analytics">Tableau de bord </div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestion Tickets/Billets </span>
        </li>
        <li class="menu-item {{ (request()->routeIs('ticket.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-id-card text-dark"  style="font-size:20px;"></i>
                <div data-i18n="Analytics">Tickets</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('ticket.index')) ? 'active' : '' }}">
                    <a href="{{ route('ticket.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Liste</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('ticket.create_or_update')) ? 'active' : '' }}">
                    <a href="{{ route('ticket.create_or_update') }}" class="menu-link">
                        <div data-i18n="Text Divider">Nouveau</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (request()->routeIs('billet.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-plane text-dark"  style="font-size:20px;"></i>
                <div data-i18n="Analytics">Billets</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('billet.index')) ? 'active' : '' }}">
                    <a href="{{ route('billet.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Liste</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('billet.create_or_update')) ? 'active' : '' }}">
                    <a href="{{ route('billet.create_or_update') }}" class="menu-link">
                        <div data-i18n="Text Divider">Nouveau</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestion des Automobiles </span>
        </li>
        <li class="menu-item {{(request()->routeIs('demande_auto_rejete.*')) || (request()->routeIs('demande_auto_encours.*')) || (request()->routeIs('demande_auto_traite.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-cube text-dark"  style="font-size:20px;"></i>
                <div data-i18n="Analytics">Demande Auto <span class="badge badge-center rounded-pill bg-warning">{{ $demande_auto_encours }}</span></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('demande_auto_encours.index')) ? 'active' : '' }}">
                    <a href="{{ route('demande_auto_encours.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Non traite <span class="badge badge-center rounded-pill bg-warning">{{ $demande_auto_encours }}</span></div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('demande_auto_rejete.index')) ? 'active' : '' }}">
                    <a href="{{ route('demande_auto_rejete.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Rejete <span class="badge badge-center rounded-pill bg-danger">{{ $demande_auto_rejete }}</span></div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('demande_auto_traite.index')) ? 'active' : '' }}">
                    <a href="{{ route('demande_auto_traite.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Traite <span class="badge badge-center rounded-pill bg-success">{{ $demande_auto_traite }}</span></div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (request()->routeIs('automobile.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-truck text-dark" style="font-size:20px;"></i>
                <div data-i18n="Analytics">Automobile</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('automobile.index')) ? 'active' : '' }}">
                    <a href="{{ route('automobile.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Liste</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('automobile.create_or_update')) ? 'active' : '' }}">
                    <a href="{{ route('automobile.create_or_update') }}" class="menu-link">
                        <div data-i18n="Text Divider">Nouveau</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (request()->routeIs('location.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-car text-dark" style="font-size:20px;"></i>
                <div data-i18n="Analytics">Location de voiture</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('location.index')) ? 'active' : '' }}">
                    <a href="{{ route('location.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Liste</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('location.create_or_update')) ? 'active' : '' }}">
                    <a href="{{ route('location.create_or_update') }}" class="menu-link">
                        <div data-i18n="Text Divider">Nouveau</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestion des Taxis </span>
        </li>
        <li class="menu-item {{(request()->routeIs('demande_taxi_rejete.*')) || (request()->routeIs('demande_taxi_encours.*')) || (request()->routeIs('demande_taxi_traite.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-cube text-dark"  style="font-size:20px;"></i>
                <div data-i18n="Analytics">Demande Taxi <span class="badge badge-center rounded-pill bg-warning">{{ $demande_taxi_encours }}</span></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('demande_taxi_encours.index')) ? 'active' : '' }}">
                    <a href="{{ route('demande_taxi_encours.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Non traite <span class="badge badge-center rounded-pill bg-warning">{{ $demande_taxi_encours }}</span></div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('demande_taxi_rejete.index')) ? 'active' : '' }}">
                    <a href="{{ route('demande_taxi_rejete.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Rejete <span class="badge badge-center rounded-pill bg-danger">{{ $demande_taxi_rejete }}</span></div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('demande_taxi_traite.index')) ? 'active' : '' }}">
                    <a href="{{ route('demande_taxi_traite.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Traite <span class="badge badge-center rounded-pill bg-success">{{ $demande_taxi_traite }}</span></div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (request()->routeIs('chauffeur.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-users text-dark" style="font-size:20px;"></i>
                <div data-i18n="Analytics">Chauffeur</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('chauffeur.index')) ? 'active' : '' }}">
                    <a href="{{ route('chauffeur.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Liste</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('chauffeur.create_or_update')) ? 'active' : '' }}">
                    <a href="{{ route('chauffeur.create_or_update') }}" class="menu-link">
                        <div data-i18n="Text Divider">Nouveau</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestion des Colis </span>
        </li>
        <li class="menu-item {{(request()->routeIs('colis_livraison_rejete.*')) || (request()->routeIs('colis_livraison_encours.*')) || (request()->routeIs('colis_livraison_traite.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-cube text-dark"  style="font-size:20px;"></i>
                <div data-i18n="Analytics">Colis Livraison <span class="badge badge-center rounded-pill bg-warning">{{ $demande_encours }}</span></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('colis_livraison_encours.index')) ? 'active' : '' }}">
                    <a href="{{ route('colis_livraison_encours.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Non traite <span class="badge badge-center rounded-pill bg-warning">{{ $demande_encours }}</span></div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('colis_livraison_rejete.index')) ? 'active' : '' }}">
                    <a href="{{ route('colis_livraison_rejete.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Rejete <span class="badge badge-center rounded-pill bg-danger">{{ $demande_rejete }}</span></div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('colis_livraison_traite.index')) ? 'active' : '' }}">
                    <a href="{{ route('colis_livraison_traite.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Traite <span class="badge badge-center rounded-pill bg-success">{{ $demande_traite }}</span></div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestion des Evenements </span>
        </li>
        <li class="menu-item {{ (request()->routeIs('evenement.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-id-card-o text-dark"  style="font-size:20px;"></i>
                <div data-i18n="Analytics">Evenements</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('evenement.index')) ? 'active' : '' }}">
                    <a href="{{ route('evenement.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Liste</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('evenement.create_or_update')) ? 'active' : '' }}">
                    <a href="{{ route('evenement.create_or_update') }}" class="menu-link">
                        <div data-i18n="Text Divider">Nouveau</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestion des Itinéraire/Quartier</span>
        </li>
        <li class="menu-item {{ (request()->routeIs('itineraire.*') || request()->routeIs('quartier.*') ) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-globe text-dark" style="font-size:20px;"></i>
                <div data-i18n="Analytics">Itinéraire/Quartier</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('itineraire.index')) ? 'active' : '' }}">
                    <a href="{{ route('itineraire.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Itinéraire</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('quartier.index')) ? 'active' : '' }}">
                    <a href="{{ route('quartier.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Quartier</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Gestion Tourisme</span>
        </li>

        <li class="menu-item {{ (request()->routeIs('tourisme.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-car text-dark" style="font-size:20px;"></i>
                <div data-i18n="Analytics">Tourisme</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('tourisme.index')) ? 'active' : '' }}">
                    <a href="{{ route('tourisme.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Liste</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('tourisme.create_or_update')) ? 'active' : '' }}">
                    <a href="{{ route('tourisme.create_or_update') }}" class="menu-link">
                        <div data-i18n="Text Divider">Nouveau</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Autres</span>
        </li>
        <li class="menu-item {{ (request()->routeIs('trajet_avion.index'))||(request()->routeIs('compagnie_aerienne.index'))||(request()->routeIs('type_coli.index')) || (request()->routeIs('categorie_permi.index')) || (request()->routeIs('compagnie.index')) || (request()->routeIs('trajet.index')) || (request()->routeIs('type_location.index')) || (request()->routeIs('type_auto.index')) ||  (request()->routeIs('info_meteo.list')) || (request()->routeIs('servicetype.*')) || (request()->routeIs('info_meteo.create_or_update')) || (request()->routeIs('temperature.index')) || (request()->routeIs('localite.*'))  ? 'active open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa fa-list text-dark" style="font-size:20px;"></i>
                <div data-i18n="Account Settings">Autres</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('compagnie.index')) ? 'active' : '' }}">
                    <a href="{{ route('compagnie.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Compagnie Car</div>
                    </a>
                </li>

                <li class="menu-item {{ (request()->routeIs('compagnie_aerienne.index')) ? 'active' : '' }}">
                    <a href="{{ route('compagnie_aerienne.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Compagnie Aerienne</div>
                    </a>
                </li>

                <li class="menu-item {{ (request()->routeIs('trajet.index')) ? 'active' : '' }}">
                    <a href="{{ route('trajet.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Trajet</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('trajet_avion.index')) ? 'active' : '' }}">
                    <a href="{{ route('trajet_avion.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Trajet Avion</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('type_location.index')) ? 'active' : '' }}">
                    <a href="{{ route('type_location.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Type Location</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('type_auto.index')) ? 'active' : '' }}">
                    <a href="{{ route('type_auto.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Type Auto</div>
                    </a>
                </li>
                  <li class="menu-item {{ (request()->routeIs('type_coli.index')) ? 'active' : '' }}">
                    <a href="{{ route('type_coli.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Type Coli</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('categorie_permi.index')) ? 'active' : '' }}">
                    <a href="{{ route('categorie_permi.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Categorie Permi</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ (request()->routeIs('user.*')) || (request()->routeIs('role.*')) ? 'active open' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog text-dark" style="font-size:20px;"></i>
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
