<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Registrar Menu</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('registrar.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>
            <a href="" class="nav-link {{ request()->routeIs('registrar.check-clearances') ? 'active' : '' }}">
                <i class="typcn typcn-document"></i> Check Clearances
            </a>
            <a href="" class="nav-link {{ request()->routeIs('registrar.release-requests') ? 'active' : '' }}">
                <i class="typcn typcn-clipboard"></i> T.O.R / H.D. Requests
            </a>
            <a href="" class="nav-link {{ request()->routeIs('registrar.reports') ? 'active' : '' }}">
                <i class="typcn typcn-chart-bar-outline"></i> Reports
            </a>
            <a href="" class="nav-link {{ request()->routeIs('registrar.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user"></i> Profile
            </a>
        </nav>
    </div>
</div>
