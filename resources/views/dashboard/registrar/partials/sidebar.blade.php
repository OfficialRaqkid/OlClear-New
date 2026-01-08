<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Registrar Menu</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('registrar.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>
            <a href="{{ route('registrar.clearances.index') }}" 
                class="nav-link {{ request()->routeIs('registrar.clearances.index') ? 'active' : '' }}">
                <i class="typcn typcn-document-add"></i> Sign Requests

            <a href="{{ route('registrar.marching.index') }}" class="nav-link {{ request()->routeIs('registrar.marching.index') ? 'active' : '' }}">
                <i class="typcn typcn-clipboard"></i> Clearance Requests
            </a>
            <a href="{{ route('registrar.reports.completed') }}"  class="nav-link {{ request()->routeIs('registrar.reports.completed') ? 'active' : '' }}">
                <i class="typcn typcn-chart-bar-outline"></i> Reports
            </a>
            <a href="" class="nav-link {{ request()->routeIs('registrar.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user"></i> Profile
            </a>
        </nav>
    </div>
</div>
