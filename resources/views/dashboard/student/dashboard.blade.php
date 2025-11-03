<x-master-layout :breadcrumbs="['Student', 'Dashboard']" sidebar="dashboard.student.partials.sidebar" navbar="dashboard.student.partials.navbar"
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
    <div class="col-lg-4">
    <div class="card card-dashboard-calendar">
        <h6 class="card-title">Clearance Status</h6>
        <div class="card-body">
            @if($latestClearance)
                <p class="mg-b-5">Latest Request:</p>

                @php
                    // Determine if the clearance is pending at the current office
                    $isPending = in_array(strtolower($latestClearance->status), ['pending', 'accepted'])
                        && !empty($latestClearance->current_office);
                @endphp

                <h5 class="text-{{ $isPending ? 'warning' : 'success' }}">
                    {{ $isPending ? 'Pending at ' . ucfirst($latestClearance->current_office) 
                                  : ucfirst($latestClearance->status) }}
                </h5>

                <p class="tx-12 text-muted">
                    Last updated: {{ $latestClearance->updated_at->format('M d, Y h:i A') }}
                </p>

                <p>
                    <strong>Current Office:</strong>
                    {{ ucfirst($latestClearance->current_office ?? 'N/A') }}
                </p>

                <a href="#" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
            @else
                <p>No clearance requests yet.</p>
            @endif
        </div>
    </div>
</div>



{{-- Recent Notifications --}}
<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Recent Notifications</h6>
            @if($recentApprovals->count() > 0)
                <ul class="list-group">
                    @foreach($recentApprovals as $approval)
                        @php
                            $badgeClass = match(strtolower($approval->status)) {
                                'approved' => 'success',
                                'pending' => 'warning',
                                'rejected' => 'danger',
                                default => 'secondary',
                            };
                            $statusText = ucfirst($approval->status);
                        @endphp

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $approval->current_office ?? 'An office' }} — {{ $statusText }}
                            <span class="badge badge-{{ $badgeClass }}">{{ $statusText }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item">
                        <a href="#" class="btn btn-link p-0">View all notifications</a>
                    </li>
                </ul>
            @else
                <p class="text-muted">No clearance updates yet.</p>
            @endif
        </div>
    </div>
</div>


        <!-- Profile Quick Info -->
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
                    <h5 class="card-title mb-0"></h5>
                    <p class="tx-12 text-muted mb-3">Student ID: {{ Auth::user()->username ?? 'N/A' }}</p>
                    <a href="" class="btn btn-sm btn-outline-secondary">View Profile</a>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>
