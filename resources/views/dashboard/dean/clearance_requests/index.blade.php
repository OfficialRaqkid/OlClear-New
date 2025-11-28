<x-master-layout  
    :breadcrumbs="['Dean', 'Department Clearance Requests']"
    sidebar="dashboard.dean.partials.sidebar"
    navbar="dashboard.dean.partials.navbar"
    footer="dashboard.student.partials.footer">

    <!-- Page Title -->
    <div class="az-dashboard-one-title mb-4">
        <div>
            <h2 class="az-dashboard-title">Department Clearance Requests</h2>
            <p class="az-dashboard-text">Manage and review student departmental clearance requests below.</p>
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
                    No department clearance requests found.
                </div>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Department</th>
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
                                <td>{{ $req->student->program->department->name ?? 'N/A' }}</td>
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
                                    <form action="{{ route('dean.clearances.accept', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm px-3">Accept</button>
                                    </form>

                                    <form action="{{ route('dean.clearances.hold', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button 
    type="button" 
    class="btn btn-warning btn-sm px-3"
    data-toggle="modal"
    data-target="#holdModal"
    data-id="{{ $req->id }}"
>
    Hold
</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- Hold Modal -->
<div class="modal fade" id="holdModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Hold Clearance Request</h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <form method="POST" id="holdForm">
                @csrf
                <div class="modal-body">
                    <label class="form-label">Reason for Hold</label>
                    <textarea name="hold_reason" class="form-control" required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Submit Hold</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const holdModal = document.getElementById('holdModal');

    holdModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const form = document.getElementById('holdForm');

        form.action = "{{ url('dean/clearance-requests') }}/" + id + "/hold";
    });
});
</script>


</x-master-layout>
