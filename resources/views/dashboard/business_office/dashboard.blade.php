<x-master-layout :breadcrumbs="['Business Office', 'Dashboard']" 
    sidebar="dashboard.business_office.partials.sidebar" 
    navbar="dashboard.business_office.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">
                Welcome, {{ $user->name ?? 'Business Office' }}!
            </h2>
            <p class="az-dashboard-text">Here’s an overview of your department’s clearance activities.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">Generate Report</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- Pending Clearances -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Pending Signatures</h6>
                    <h3 class="text-warning">12 Requests</h3>
                    <p class="text-muted">Awaiting review & signature</p>
                    <a href="" class="btn btn-sm btn-outline-primary">View Requests</a>
                </div>
            </div>
        </div>

        <!-- Approved this Month -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Approved Clearances</h6>
                    <h3 class="text-success">37</h3>
                    <p class="text-muted">This month</p>
                    <a href="" class="btn btn-sm btn-outline-success">View History</a>
                </div>
            </div>
        </div>

        <!-- Department Summary -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">Department Summary</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Students Cleared: <strong>120</strong></li>
                        <li class="list-group-item">Pending Students: <strong>18</strong></li>
                        <li class="list-group-item">Total Requests: <strong>152</strong></li>
                    </ul>
                    <a href="" class="btn btn-sm btn-outline-info mt-2">More Insights</a>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
