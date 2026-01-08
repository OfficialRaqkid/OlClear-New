<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Librarian Menu</label>
        <nav class="nav flex-column">
            <a href="{{ route('library_in_charge.dashboard') }}" class="nav-link {{ request()->routeIs('library_in_charge.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>
            <a href="{{ route('library_in_charge.clearances.index') }}" 
            class="nav-link {{ request()->routeIs('library_in_charge.clearances.index') ? 'active' : '' }}">
            <i class="typcn typcn-document-add"></i> Sign Requests
            </a>
        </nav>
    </div>
</div>
