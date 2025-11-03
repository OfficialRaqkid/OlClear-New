<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Dean Menu</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('dean.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>
  <a href="{{ route('business_office.clearance_requests.index') }}" class="nav-link {{ request()->routeIs('business_office.clearance_requests.index') ? 'active' : '' }}">
    <i class="typcn typcn-document-add"></i> Sign Requests
  </a>
            </a>
            <a href="" class="nav-link {{ request()->routeIs('dean.history') ? 'active' : '' }}">
                <i class="typcn typcn-time"></i> Clearance History
            </a>
  <a href="{{ route('business_office.clearances.index') }}" class="nav-link {{ request()->routeIs('business_office.clearances.index') ? 'active' : '' }}">
    <i class="typcn typcn-folder"></i> Manage Clearances
  </a>
            </a>
            <a href="" class="nav-link {{ request()->routeIs('dean.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user"></i> Profile
            </a>
        </nav>
    </div>
</div>
