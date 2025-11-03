<x-master-layout 
    :breadcrumbs="['Student', 'Financial Clearances']"
    sidebar="dashboard.student.partials.sidebar"
    navbar="dashboard.student.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Clearances</h2>
            <p class="az-dashboard-text">Clearances available for request.</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            @if ($clearances->isEmpty())
                <div class="text-center text-muted py-5">
                    No active financial clearances available at the moment.
                </div>
            @else
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status / Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clearances as $clearance)
                            @php
                                $existingRequest = auth()->user()->studentProfile
                                    ? auth()->user()->studentProfile->clearanceRequests()
                                        ->where('clearance_id', $clearance->id)
                                        ->latest()
                                        ->first()
                                    : null;
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $clearance->title }}</td>
                                <td>{{ $clearance->description ?? '—' }}</td>
                                <td>
                                    @if ($existingRequest)
                                        @if ($existingRequest->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($existingRequest->status === 'held')
                                            <span class="badge bg-danger">On Hold</span>
                                        @elseif ($existingRequest->status === 'accepted')
                                            <span class="badge bg-success">Done</span>
                                        @elseif ($existingRequest->status === 'completed')
                                            <span class="badge bg-primary">Completed</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($existingRequest->status) }}</span>
                                        @endif
                                    @else
                                        <form action="{{ route('student.clearances.request', $clearance->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">Request</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-master-layout>
