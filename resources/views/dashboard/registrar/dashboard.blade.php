<x-master-layout :breadcrumbs="['Registrar', 'Dashboard']" 
    sidebar="dashboard.registrar.partials.sidebar" 
    navbar="dashboard.registrar.partials.navbar"
    footer="dashboard.student.partials.footer">

    <h2>Welcome, {{ $user->name ?? 'Registrar' }}</h2>
    <p>This is the registrar’s dashboard.</p>
            <p class="az-dashboard-text">Here’s the current state of clearance and document requests.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">Export Report</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- Clearance Queue -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Clearance Queue</h6>
                    <h3 class="text-warning">24 Pending</h3>
                    <p class="text-muted">Students waiting for final verification</p>
                    <a href="" class="btn btn-sm btn-outline-primary">Check Now</a>
                </div>
            </div>
        </div>

        <!-- Document Requests -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">T.O.R / Honorable Dismissal</h6>
                    <h3 class="text-info">8 Requests</h3>
                    <p class="text-muted">Pending document release approvals</p>
                    <a href="" class="btn btn-sm btn-outline-info">Process</a>
                </div>
            </div>
        </div>

        <!-- Monthly Summary -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">This Month</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Verified Clearances: <strong>112</strong></li>
                        <li class="list-group-item">T.O.R. Released: <strong>31</strong></li>
                        <li class="list-group-item">Total Students: <strong>350</strong></li>
                    </ul>
                    <a href="" class="btn btn-sm btn-outline-secondary mt-2">Detailed Report</a>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
