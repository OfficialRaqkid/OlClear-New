<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Navigation</label>
        <nav class="nav flex-column">
            <a href="{{ route('student.dashboard') }}"  class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>
            <a href="" class="nav-link {{ request()->routeIs('student.request-clearance') ? 'active' : '' }}">
                <i class="typcn typcn-document-add"></i> Request Clearance
            </a>
            <a href="{{ route('student.clearances.index') }}" 
            class="nav-link {{ request()->routeIs('student.clearances.index') ? 'active' : '' }}">
                <i class="typcn typcn-clipboard"></i> My Clearances
            </a>
            <a href="" class="nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user-outline"></i> Profile
            </a>
            <a href="" class="nav-link {{ request()->routeIs('student.notifications') ? 'active' : '' }}">
                <i class="typcn typcn-bell"></i> Notifications
            </a>
        </nav>
    </div>
</div>
