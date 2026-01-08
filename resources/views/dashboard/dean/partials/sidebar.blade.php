<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Dean Menu</label>

        <nav class="nav flex-column">

            {{-- Dashboard --}}
            <a href="{{ route('dean.dashboard') }}"
               class="nav-link {{ request()->routeIs('dean.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>

            {{-- Sign Clearance Requests --}}
            <a href="{{ route('dean.clearance_requests.index') }}"
               class="nav-link {{ request()->routeIs('dean.clearance_requests.index') ? 'active' : '' }}">
                <i class="typcn typcn-document-add"></i> Sign Requests
            </a>

            {{-- Manage Clearances --}}
            <a href="{{ route('dean.clearances.index') }}"
               class="nav-link {{ request()->routeIs('dean.clearances.index') ? 'active' : '' }}">
                <i class="typcn typcn-folder"></i> Manage Clearances
            </a>

            {{-- Completed / Reports --}}
            <a href="{{ route('dean.completed') }}"
               class="nav-link {{ request()->routeIs('dean.completed') ? 'active' : '' }}">
                <i class="typcn typcn-chart-bar-outline"></i> Reports
            </a>

        </nav>
    </div>
</div>
