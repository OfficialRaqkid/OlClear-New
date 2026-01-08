<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Dean Menu</label>
        <nav class="nav flex-column">
                          <li class="nav-item">
<a href="{{ route('business_office.dashboard') }}" 
   class="nav-link {{ request()->routeIs('business_office.dashboard') ? 'active' : '' }}">
    <i class="typcn typcn-home"></i> Dashboard
</a>

                <li class="nav-item">
  <a href="{{ route('business_office.clearance_requests.index') }}" class="nav-link {{ request()->routeIs('business_office.clearance_requests.index') ? 'active' : '' }}">
    <i class="typcn typcn-document-add"></i> Sign Requests
  </a>
            </a>
                <li class="nav-item">
              <a href="{{ route('business_office.clearances.index') }}" class="nav-link {{ request()->routeIs('business_office.clearances.index') ? 'active' : '' }}">
    <i class="typcn typcn-folder"></i> Manage Clearances
  </a>

                  <li class="nav-item">
      <a href="{{ route('business_office.reports.completed') }}" 
        class="nav-link {{ request()->routeIs('business_office.reports.completed') ? 'active' : '' }}">
          <i class="typcn typcn-chart-bar-outline"></i> Reports
      </a>
        </nav>
    </div>
</div>
