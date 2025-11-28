<x-master-layout  
    :breadcrumbs="['Business Office', 'Clearance Requests']"
    sidebar="dashboard.business_office.partials.sidebar"
    navbar="dashboard.business_office.partials.navbar"
    footer="dashboard.student.partials.footer">

    <!-- 📘 Page Header -->
     <!-- Page Title -->
    <div class="az-dashboard-one-title mb-4">
        <div>
            <h2 class="az-dashboard-title">Library Clearance Requests</h2>
            <p class="az-dashboard-text">Manage and review student library clearance requests below.</p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning shadow-sm">{{ session('warning') }}</div>
    @endif

    <!-- Table Section -->
    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body p-0">
            @if ($requests->isEmpty())
                <div class="text-center py-5 text-muted">
                    No library clearance requests found.
                </div>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Program</th>
                            <th>Year Level</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $key => $req)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $req->student->first_name ?? 'N/A' }} {{ $req->student->last_name ?? '' }}</td>
                                <td>{{ $req->student->program->name ?? 'N/A' }}</td>
                                <td>{{ $req->student->yearLevel->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($req->status == 'pending') bg-warning 
                                        @elseif($req->status == 'accepted') bg-success 
                                        @elseif($req->status == 'held') bg-danger 
                                        @else bg-secondary @endif">
                                        {{ ucfirst($req->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('business_office.clearances.accept', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm px-3">Accept</button>
                                    </form>

                                    <form action="{{ route('library_in_charge.clearances.hold', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm px-3">Hold</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</x-master-layout>
