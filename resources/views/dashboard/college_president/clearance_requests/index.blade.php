<x-master-layout
    :breadcrumbs="['College President', 'Final Clearance Approval']"
    sidebar="dashboard.college_president.partials.sidebar"
    navbar="dashboard.college_president.partials.navbar"
    footer="dashboard.student.partials.footer">

<div class="az-dashboard-one-title mb-4">
    <div>
        <h2 class="az-dashboard-title">Final Clearance Approval</h2>
        <p class="az-dashboard-text">
            Final institutional approval before clearance completion.
        </p>
    </div>
</div>
<div class="card shadow-sm border-0 mt-3">
    <div class="card-body p-0">

        @if ($requests->isEmpty())
            <div class="text-center py-5 text-muted">
                No pending clearances.
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
                        <th>Clearance Type</th>
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
                        <td>{{ $req->clearance->clearanceType->name }}</td>

                    <td>
                        <span class="badge
                            @if($req->status === 'pending') bg-warning
                            @elseif($req->status === 'accepted') bg-success
                            @elseif($req->status === 'held') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($req->status) }}
                        </span>
                    </td>

                    <td class="text-center">

                        {{-- IF HELD --}}
                        @if ($req->status === 'held')
                            <button
                                class="btn btn-info btn-sm"
                                data-toggle="modal"
                                data-target="#viewModal"
                                data-id="{{ $req->id }}"
                                data-reason="{{ $req->hold_reason }}">
                                View
                            </button>

                        @else
                            {{-- APPROVE --}}
                            <form
                                action="{{ route('college_president.clearances.accept', $req->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    Final Approve
                                </button>
                            </form>

                            {{-- HOLD --}}
                            <button
                                type="button"
                                class="btn btn-warning btn-sm"
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

{{-- HOLD MODAL --}}
<div class="modal fade" id="holdModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Hold Clearance</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" id="holdForm">
                @csrf
                <div class="modal-body">
                    <label class="form-label">Reason for Hold</label>
                    <textarea
                        name="hold_reason"
                        class="form-control"
                        required></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-warning" type="submit">
                        Submit Hold
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- VIEW HELD MODAL --}}
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
                <form method="POST" id="viewApproveForm">
                    @csrf
                    <button class="btn btn-success" type="submit">
                        Approve Now
                    </button>
                </form>
                <button class="btn btn-secondary" data-dismiss="modal">
                    Cancel
                </button>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // HOLD
    $('#holdModal').on('show.bs.modal', function (event) {
        let id = $(event.relatedTarget).data('id');
        document.getElementById('holdForm').action =
            "/president/clearances/" + id + "/hold";
    });

    // VIEW HELD
    $('#viewModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let id = button.data('id');
        let reason = button.data('reason');

        $('#viewReason').text(reason);
        document.getElementById('viewApproveForm').action =
            "/president/clearances/" + id + "/approve";
    });

});
</script>

</x-master-layout>
