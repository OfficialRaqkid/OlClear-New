<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Student Affairs</label>
        <nav class="nav flex-column">
            <a href="{{ route('vp_sas.dashboard') }}" class="nav-link {{ request()->routeIs('vp_sas.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home-outline"></i> Dashboard
            </a>
            <a href="{{ route('vp_sas.clearances.index') }}" 
                class="nav-link {{ request()->routeIs('vp_sas.clearances.index') ? 'active' : '' }}">
                <i class="typcn typcn-document-add"></i> Sign Requests
            </a>
        </nav>
    </div>
</div>
