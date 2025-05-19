<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
            data-kt-menu="true" data-kt-menu-expand="false">

            <!-- Tableau de bord -->
            <div class="menu-item {{ request()->routeIs('dashboard') ? 'here show' : '' }}">
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <span class="menu-icon"><i class="fas fa-tachometer-alt fs-2"></i></span>
                    <span class="menu-title">TABLEAU DE BORD</span>
                </a>
            </div>

            @if (Auth::user()->role === 'admin')
                <!-- Utilisateurs et rôles -->
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon"><i class="fas fa-users-cog fs-2"></i></span>
                        <span class="menu-title">Utilisateurs et rôles</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}"
                                href="{{ route('user-management.users.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Utilisateurs</span>
                            </a>
                        </div> 
                    </div>
                </div>
            @endif

            <!-- Classement -->
        @if (in_array(Auth::user()->role,['admin','intendant','chef_cite','chef_batiment','caissiere']))
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('classements.*') ? 'here show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon"><i class="fas fa-chart-bar fs-2"></i></span>
                    <span class="menu-title">Classement</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('classements.index') ? 'active' : '' }}"
                            href="{{ route('classements.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Voir Classements</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif


            <!-- Demandes -->
        @if (in_array(Auth::user()->role,['admin','intendant']))
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('admin.demandes.*') ? 'here show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon"><i class="fas fa-envelope-open-text fs-2"></i></span>
                    <span class="menu-title">Demandes</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.demandes.index') ? 'active' : '' }}"
                            href="{{ route('admin.demandes.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Voir Demandes</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif


            <!-- Résidences -->
        @if (in_array(Auth::user()->role,['admin','intendant']))
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion
                {{ request()->routeIs('cities.*') || request()->routeIs('batiments.*') || request()->routeIs('cabines.*') ? 'here show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon"><i class="fas fa-building fs-2"></i></span>
                    <span class="menu-title">Résidences</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('cities.*') ? 'active' : '' }}"
                                href="{{ route('cities.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Cités</span>
                            </a>
                        </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('batiments.*') ? 'active' : '' }}"
                            href="{{ route('batiments.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Bâtiments</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('cabines.*') ? 'active' : '' }}"
                            href="{{ route('cabines.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Cabines</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif

            <!-- Paramètre -->

        @if (in_array(Auth::user()->role,['admin','intendant']))
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion
                {{ request()->routeIs('annees-academiques.*') || request()->routeIs('planifications.*') ? 'here show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon"><i class="fas fa-cogs fs-2"></i></span>
                    <span class="menu-title">Paramètre</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('annees-academiques.*') ? 'active' : '' }}"
                            href="{{ route('annees-academiques.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Année académique</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('planifications.*') ? 'active' : '' }}"
                            href="{{ route('planifications.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Planification</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
