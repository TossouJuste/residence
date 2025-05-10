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
            <!--begin:Menu item-->
            <div class="menu-item {{ request()->routeIs('dashboard') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
                    <span class="menu-title">TABLEAU DE BORD</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->

            @if (Auth::user()->role === 'admin')
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
                        <span class="menu-title">Utilisateurs et roles</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}"
                                href="{{ route('user-management.users.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Utilisateurs</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs('user-management.roles.*') ? 'active' : '' }}"
                                href="{{ route('user-management.roles.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Roles</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs('user-management.permissions.*') ? 'active' : '' }}"
                                href="{{ route('user-management.permissions.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Permissions</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
            @endif
            <!--begin:Menu item-->

            <!--end:Menu item-->




            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('classements.*') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
                    <span class="menu-title">Classement</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('classements.index') ? 'active' : '' }}"
                            href="{{ route('classements.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Voir Classements</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->

            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ request()->routeIs('admin.demandes.*') ? 'here show' : '' }}">

                <!--begin:Menu link-->
                <span class="menu-link">
                    <span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
                    <span class="menu-title">Demandes</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->

                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!-- Voir Demandes -->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.demandes.index') ? 'active' : '' }}"
                            href="{{ route('admin.demandes.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Voir Demandes</span>
                        </a>
                    </div>
                </div>
                <!--end:Menu sub-->

            </div>
            <!--end:Menu item-->



            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion
{{ request()->routeIs('cities.*') || request()->routeIs('batiments.*') || request()->routeIs('cabines.*') ? 'here show' : '' }}">

                <!--begin:Menu link-->
                <span class="menu-link">
                    <span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
                    <span class="menu-title">Résidences</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->

                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    @if (in_array(Auth::user()->role,['admin','intendant','chef_cite']))
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('cities.*') ? 'active' : '' }}"
                            href="{{ route('cities.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Cités</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endif
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('batiments.*') ? 'active' : '' }}"
                            href="{{ route('batiments.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Bâtiments</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->routeIs('cabines.*') ? 'active' : '' }}"
                            href="{{ route('cabines.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Cabines</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->




            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion
    {{ request()->routeIs('annees-academiques.*') || request()->routeIs('planifications.*') ? 'here show' : '' }}">

                <!--begin:Menu link-->
                <span class="menu-link">
                    <span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
                    <span class="menu-title">Paramètre</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->

                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!-- Année académique -->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('annees-academiques.*') ? 'active' : '' }}"
                            href="{{ route('annees-academiques.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Année académique</span>
                        </a>
                    </div>

                    <!-- Planification -->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('planifications.*') ? 'active' : '' }}"
                            href="{{ route('planifications.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Planification</span>
                        </a>
                    </div>
                </div>
                <!--end:Menu sub-->

            </div>
            <!--end:Menu item-->










            <!--begin:Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
