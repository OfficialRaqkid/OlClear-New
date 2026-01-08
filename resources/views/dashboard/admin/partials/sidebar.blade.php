<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Admin Menu</label>
        <nav class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" 
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>
           <a href="{{ route('admin.users') }}"
   class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
    <i class="typcn typcn-user-add"></i> Manage Users
</a>
            </a>
            <a href="{{ route('admin.clearances.index') }}" 
            class="nav-link {{ request()->routeIs('admin.clearances.index') ? 'active' : '' }}">
                <i class="typcn typcn-document-text"></i> Clearance Types
            </a>

            <a href="{{ route('admin.system-logs') }}" 
            class="nav-link {{ request()->routeIs('admin.system-logs') ? 'active' : '' }}">
                <i class="typcn typcn-time"></i> System Logs
            </a>

            </a>
            <a href="" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="typcn typcn-cog"></i> Settings
            </a>
        </nav>
    </div>
</div>
