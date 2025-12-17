<x-master-layout  
    :breadcrumbs="['Business Office', 'Completed Clearances']"
    sidebar="dashboard.business_office.partials.sidebar"
    navbar="dashboard.business_office.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title mb-4">
        <div>
            <h2 class="az-dashboard-title">Completed Student Clearances</h2>
            <p class="az-dashboard-text">View students whose clearances have been fully signed and completed.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @if ($completedRequests->isEmpty())
                <div class="text-center py-5 text-muted">
                    No completed clearances found.
                </div>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Program</th>
                            <th>Year Level</th>
                            <th>Status</th>
                            <th>Completed Date</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($completedRequests->where('clearance_id', 3) as $key => $req)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $req->student->first_name ?? 'N/A' }} {{ $req->student->last_name ?? '' }}</td>
                                    <td>{{ $req->student->program->name ?? 'N/A' }}</td>
                                    <td>{{ $req->student->yearLevel->name ?? 'N/A' }}</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>{{ $req->updated_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            @endif
        </div>
    </div>

</x-master-layout>
