<x-master-layout :breadcrumbs="['Admin', 'Dashboard']" 
    sidebar="dashboard.admin.partials.sidebar" 
    navbar="dashboard.admin.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">
                Welcome, {{ Auth::user()->name ?? 'Admin' }}!
            </h2>
            <p class="az-dashboard-text">
                Here’s an overview of the clearance system metrics and administration.
            </p>
        </div>
        <div class="az-content-header-right">
            <a href="#" class="btn btn-purple">System Settings</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">

        <!-- User Accounts -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Active Users</h6>
                    <h3 class="text-primary">145 Users</h3>
                    <p class="text-muted">Including students and staff</p>

                    <!-- Page-based navigation (NO MODAL) -->
                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary">
                        Manage Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Clearance Templates -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Clearance Types</h6>
                    <h3 class="text-info">4 Workflows</h3>
                    <p class="text-muted">
                        Marching, Financial, Release, Department
                    </p>
                    <a href="#" class="btn btn-sm btn-outline-info">
                        Edit Workflows
                    </a>
                </div>
            </div>
        </div>

        <!-- Logs -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">Recent Logs</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Login Events: <strong>350</strong></li>
                        <li class="list-group-item">Changes Made: <strong>75</strong></li>
                        <li class="list-group-item">New Accounts: <strong>22</strong></li>
                    </ul>
                    <a href="#" class="btn btn-sm btn-outline-secondary mt-2">
                        View Logs
                    </a>
                </div>
            </div>
        </div>

    </div>

</x-master-layout>
