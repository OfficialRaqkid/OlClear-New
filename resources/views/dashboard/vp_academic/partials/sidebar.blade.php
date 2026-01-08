<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Academic Menu</label>
        <nav class="nav flex-column">
            <a href="{{ route('vp_academic.dashboard') }}" 
                 class="nav-link {{ request()->routeIs('vp_academic.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home-outline"></i> Dashboard
            </a>
            <a href="{{ route('vp_academic.clearances.index') }}" 
                class="nav-link {{ request()->routeIs('vp_academic.clearances.index') ? 'active' : '' }}">
                <i class="typcn typcn-document-add"></i> Attest Clearances
            </a>
        </nav>
    </div>
</div>
