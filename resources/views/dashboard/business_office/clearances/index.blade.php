<x-master-layout 
    :breadcrumbs="['Business Office', 'Financial Clearances']"
    sidebar="dashboard.business_office.partials.sidebar"
    navbar="dashboard.business_office.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Financial Clearances</h2>
            <p class="az-dashboard-text">List of all published financial clearances assigned to your office.</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($clearances->isEmpty())
                <div class="text-center text-muted py-5">
                    No published financial clearances yet.
                </div>
            @else
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clearances as $clearance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $clearance->title }}</td>
                                <td>{{ $clearance->description ?? '—' }}</td>
                                <td>
                                    @if ($clearance->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$clearance->is_active)
                                        <form action="{{ route('business_office.clearances.activate', $clearance->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="typcn typcn-upload"></i> Activate for Students
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
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
