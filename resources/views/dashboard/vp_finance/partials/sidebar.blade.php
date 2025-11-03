<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Finance Menu</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('vp_finance.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home-outline"></i> Dashboard
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_finance.approve-clearances') ? 'active' : '' }}">
                <i class="typcn typcn-tick"></i> Approve Requests
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_finance.accounts') ? 'active' : '' }}">
                <i class="typcn typcn-user"></i> Student Accounts
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_finance.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user-outline"></i> Profile
            </a>
        </nav>
    </div>
</div>
