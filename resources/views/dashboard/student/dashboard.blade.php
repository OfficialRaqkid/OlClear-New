<x-master-layout :breadcrumbs="['Student', 'Dashboard']" 
    sidebar="dashboard.student.partials.sidebar" 
    navbar="dashboard.student.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Hi , welcome back!</h2>
            <p class="az-dashboard-text">Here's an overview of your clearance status and recent activity.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">Request Clearance</a>
        </div>
    </div>

<div class="row row-sm mg-b-20">

    {{-- Clearance Status --}}
    @if ($latestClearance)
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <h6 class="card-title">Clearance Status</h6>
                <div class="card-body">

                    <p class="mg-b-5">Latest Request:</p>

                    @php
                        $status = strtolower($latestClearance->status);
                        $isPending = in_array($status, ['pending', 'accepted']) 
                            && !empty($latestClearance->current_office);
                    @endphp

                    <h5 class="text-{{ 
                        $status === 'held' ? 'danger' : 
                        ($status === 'completed' ? 'success' : ($isPending ? 'warning' : 'secondary')) 
                    }}">
                        @if ($status === 'held')
                            On Hold
                        @elseif ($status === 'completed')
                            Completed
                        @elseif ($isPending)
                            Pending at {{ ucfirst($latestClearance->current_office ?? 'N/A') }}
                        @else
                            {{ ucfirst($latestClearance->status) }}
                        @endif
                    </h5>

                    <p class="tx-12 text-muted">
                        Last updated: {{ $latestClearance->updated_at->format('M d, Y h:i A') }}
                    </p>

                    <p>
                        <strong>Current Office:</strong>
                        {{ ucfirst($latestClearance->current_office ?? 'N/A') }}
                    </p>

                    {{-- Show hold reason --}}
                    @if ($status === 'held' && !empty($latestClearance->hold_reason))
                        <div class="alert alert-warning mt-2">
                            <strong>Reason for Hold:</strong><br>
                            {{ $latestClearance->hold_reason }}
                        </div>
                    @endif

                    {{-- View Details Button always visible --}}
                    <a href="{{ route('student.clearances.index', $latestClearance->id) }}" 
                       class="btn btn-sm btn-outline-primary mt-2">
                        View Details
                    </a>

                </div>
            </div>
        </div>

    @else
        {{-- NO REQUEST — Show this box only when student has no clearance --}}
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <h6 class="card-title">Clearance Status</h6>
                <div class="card-body">
                    <p class="mg-b-5">No clearance request found.</p>
                    <a href="{{ route('student.clearances.index') }}" class="btn btn-sm btn-outline-primary">Request Clearance</a>
                </div>
            </div>
        </div>
    @endif
</div>



        {{-- Profile Quick Info --}}
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body text-center">
                    <img
                        src="{{ $student && $student->profile_photo
                                ? asset('storage/' . $student->profile_photo)
                                : asset('img/faces/default.jpg') }}"
                        alt="Profile Photo"
                        onerror="this.src='{{ asset('img/faces/default.jpg') }}';"
                        class="wd-80 rounded-circle mb-3">

                    <h5 class="card-title mb-0">{{ Auth::user()->name ?? 'Student' }}</h5>
                    <p class="tx-12 text-muted mb-3">Student ID: {{ Auth::user()->username ?? 'N/A' }}</p>

                    <a href="" class="btn btn-sm btn-outline-secondary">View Profile</a>
                </div>
            </div>
        </div>

    </div>

</x-master-layout>
