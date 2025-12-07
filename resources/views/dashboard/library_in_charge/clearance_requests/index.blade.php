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
                        <td>{{ $req->student->first_name }} {{ $req->student->last_name }}</td>
                        <td>{{ $req->student->program->department->name }}</td>
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

                            {{-- IF REQUEST IS HELD --}}
                            @if ($req->status == 'held')
                                <button class="btn btn-info btn-sm px-3"
                                    data-toggle="modal"
                                    data-target="#viewModal"
                                    data-id="{{ $req->id }}"
                                    data-reason="{{ $req->hold_reason }}">
                                    View
                                </button>
                            @else
                                {{-- ACCEPT BUTTON --}}
                                <form action="{{ route('library_in_charge.clearances.accept', $req->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm px-3">Sign</button>
                                </form>

                                {{-- HOLD BUTTON --}}
                                <button 
                                    type="button"
                                    class="btn btn-warning btn-sm px-3"
                                    data-toggle="modal"
                                    data-target="#holdModal"
                                    data-id="{{ $req->id }}">
                                    Hold
                                </button>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            @endif

        </div>
    </div>

<!-- HOLD MODAL -->
<div class="modal fade" id="holdModal">
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

<!-- VIEW (HELD REQUEST) MODAL -->
<div class="modal fade" id="viewModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Held Clearance Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p><strong>Hold Reason:</strong></p>
                <p id="viewReason" class="border rounded p-2 bg-light"></p>
            </div>

            <div class="modal-footer">
                <form method="POST" id="viewSignForm">
                    @csrf
                    <button type="submit" class="btn btn-success">Sign Now</button>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    // HOLD MODAL
    $('#holdModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        document.getElementById('holdForm').action = "/library_in_charge/clearance-requests/" + id + "/hold";
    });

    // VIEW MODAL (HELD REQUEST)
    $('#viewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var reason = button.data('reason');

        $('#viewReason').text(reason);
        document.getElementById('viewSignForm').action = "/library_in_charge/clearance-requests/" + id + "/accept";
    });

});
</script>

</x-master-layout>
