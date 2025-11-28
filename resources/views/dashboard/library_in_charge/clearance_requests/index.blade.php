<x-master-layout 
    :breadcrumbs="['Library In-Charge', 'Library Clearances']"
    sidebar="dashboard.library_in_charge.partials.sidebar"
    navbar="dashboard.library_in_charge.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title mb-4">
        <div>
            <h2 class="az-dashboard-title">Library Clearance Requests</h2>
            <p class="az-dashboard-text">Manage and review student library clearance requests below.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning shadow-sm">{{ session('warning') }}</div>
    @endif

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
                                <td>{{ $req->student->first_name }} {{ $req->student->last_name }}</td>
                                <td>{{ $req->student->program->name }}</td>
                                <td>{{ $req->student->yearLevel->name }}</td>

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

                                    {{-- Accept --}}
                                    <form action="{{ route('library_in_charge.clearances.accept', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm px-3">Sign</button>
                                    </form>

                                    {{-- Hold --}}
                                    <button 
                                        type="button"
                                        class="btn btn-warning btn-sm px-3"
                                        data-toggle="modal"
                                        data-target="#holdModal"
                                        data-id="{{ $req->id }}">
                                        Hold
                                    </button>

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
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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

    {{-- JS for dynamic form action --}}
    <script>
        $('#holdModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var requestId = button.data('id');
            
            // Update form action dynamically
            $('#holdForm').attr('action', '/library_in_charge/clearance-requests/' + requestId + '/hold');
        });
    </script>

</x-master-layout>
