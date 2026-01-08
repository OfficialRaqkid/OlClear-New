<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>College President Menu</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('college_president.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home-outline"></i> Dashboard
            </a>
            <a href="{{ route('college_president.clearance_requests.index') }}" class="nav-link {{ request()->routeIs('college_president.clearance_requests.index') ? 'active' : '' }}">
                <i class="typcn typcn-tick"></i> Approve Requests
            </a>
            <a href="{{ route('college_president.student_accounts') }}"
            class="nav-link {{ request()->routeIs('college_president.student_accounts') ? 'active' : '' }}">
                <i class="typcn typcn-user"></i> Student Accounts
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_finance.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user-outline"></i> Profile
            </a>
        </nav>
    </div>
</div>
