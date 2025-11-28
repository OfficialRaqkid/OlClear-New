<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Dean Menu</label>
        <nav class="nav flex-column">
<a href="{{ route('business_office.dashboard') }}" 
   class="nav-link {{ request()->routeIs('business_office.dashboard') ? 'active' : '' }}">
    <i class="typcn typcn-home"></i> Dashboard
</a>

  <a href="{{ route('business_office.clearance_requests.index') }}" class="nav-link {{ request()->routeIs('business_office.clearance_requests.index') ? 'active' : '' }}">
    <i class="typcn typcn-document-add"></i> Sign Requests
  </a>
            </a>
<a href="{{ route('business_office.reports.completed') }}" 
   class="nav-link {{ request()->routeIs('business_office.reports.completed') ? 'active' : '' }}">
    <i class="typcn typcn-chart-bar-outline"></i> Reports
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
