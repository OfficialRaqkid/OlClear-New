<x-master-layout 
    :breadcrumbs="['Library In-Charge', 'Dashboard']" 
    sidebar="dashboard.library_in_charge.partials.sidebar" 
    navbar="dashboard.library_in_charge.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">
                Welcome, {{ Auth::user()->name ?? 'Library In-Charge' }}!
            </h2>
            <p class="az-dashboard-text">
                Manage book clearances and library-related requirements for students.
            </p>
        </div>
        <div class="az-content-header-right">
            <a href="{{ route('library_in_charge.clearances.index') }}" class="btn btn-purple">Review Pending Requests</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- Pending Library Clearances -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Pending Clearances</h6>
                    <h3 class="text-warning">{{ $pendingCount }}</h3>
                    <p class="text-muted">Awaiting your approval</p>
                    <a href="{{ route('library_in_charge.clearances.index') }}" class="btn btn-sm btn-outline-primary">View Requests</a>
                </div>
            </div>
        </div>

        <!-- Cleared Students -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Cleared Students</h6>
                    <h3 class="text-success">{{ $clearedCount }}</h3>
                    <p class="text-muted">Successfully cleared this month</p>
                    <a href="{{ route('library_in_charge.clearances.index') }}" class="btn btn-sm btn-outline-success">View List</a>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">Library Summary</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Cleared: <strong>{{ $clearedCount }}</strong></li>
                        <li class="list-group-item">Pending: <strong>{{ $pendingCount }}</strong></li>
                        <li class="list-group-item">Overdue: <strong>{{ $overdueCount }}</strong></li>
                    </ul>
                    <a href="{{ route('library_in_charge.clearances.index') }}" class="btn btn-sm btn-outline-info mt-2">View Details</a>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>
