<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Academic Menu</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('vp_academic.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home-outline"></i> Dashboard
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_academic.attest-clearances') ? 'active' : '' }}">
                <i class="typcn typcn-tick"></i> Attest Clearances
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_academic.logs') ? 'active' : '' }}">
                <i class="typcn typcn-document"></i> Review Logs
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_academic.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user-outline"></i> Profile
            </a>
        </nav>
    </div>
</div>
