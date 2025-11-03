<x-master-layout :breadcrumbs="['Dean', 'Dashboard']" 
    sidebar="dashboard.dean.partials.sidebar" 
    navbar="dashboard.dean.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">
                Welcome, {{ $user->name ?? 'Dean' }}!
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

            {{-- Dynamic pending count --}}
            <h3 class="text-warning">
                {{ $pendingCount }} {{ Str::plural('Request', $pendingCount) }}
            </h3>

            {{-- Conditional text --}}
            <p class="text-muted">
                {{ $pendingCount > 0 ? 'Awaiting your review & signature' : 'No pending requests at the moment' }}
            </p>

            {{-- View Requests button --}}
<a href="{{ route('dean.clearances.index') }}" class="btn btn-sm btn-outline-primary">
    View Requests
</a>

        </div>
    </div>
</div>


        <!-- Approved this Month -->
<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Approved Clearances</h6>

            {{-- Dynamic count --}}
            <h3 class="text-success">{{ $approvedCount }}</h3>

            {{-- Conditional description --}}
            <p class="text-muted">
                {{ $approvedCount > 0 ? 'Clearances you approved' : 'No approvals yet' }}
            </p>

            <a href="{{ route('dean.clearances.index') }}" class="btn btn-sm btn-outline-success">
                View History
            </a>
        </div>
    </div>
</div>


        <!-- Department Summary -->
<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Approved Clearances</h6>
            <h3 class="text-success">{{ $approvedCount ?? 0 }}</h3>
            <p class="text-muted">This month</p>
            <a href="{{ route('dean.clearances.index') }}" class="btn btn-sm btn-outline-success">View History</a>
        </div>
    </div>
</div>


</x-master-layout>
