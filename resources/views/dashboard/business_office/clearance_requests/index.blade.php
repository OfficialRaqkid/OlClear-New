<x-master-layout  
    :breadcrumbs="['Business Office', 'Clearance Requests']"
    sidebar="dashboard.business_office.partials.sidebar"
    navbar="dashboard.business_office.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title mb-4">
        <div>
            <h2 class="az-dashboard-title">Business Office Clearance Requests</h2>
            <p class="az-dashboard-text">Manage and review student clearance requests below.</p>
        </div>
    </div>

    {{-- ALERTS --}}
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
                    No clearance requests found.
                </div>
            @else
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Department</th>
                        <th>Year Level</th>
                        <th>Clearance Type</th>
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
                        <td>{{ $req->clearance->clearanceType->name }}</td>
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
                            @if ($req->status == 'held')
                                <button class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#viewModal"
                                    data-id="{{ $req->id }}"
                                    data-reason="{{ $req->hold_reason }}">
                                    View
                                </button>

                            @elseif ($req->status != 'completed')
                                {{-- SIGN --}}
                                <form action="{{ route('business_office.clearance_requests.accept', $req->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Sign
                                    </button>
                                </form>

                                {{-- HOLD --}}
                                <button type="button"
                                    class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#holdModal"
                                    data-id="{{ $req->id }}">
                                    Hold
                                </button>
                            @else
                                <span class="text-muted">Completed</span>
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
                        <textarea name="hold_reason" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- VIEW HELD --}}
    <div class="modal fade" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Held Reason</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p id="viewReason" class="bg-light p-2 rounded"></p>
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

    $('#holdModal').on('show.bs.modal', function (event) {
        let id = $(event.relatedTarget).data('id');
        document.getElementById('holdForm').action =
            "/business-office/clearance-requests/" + id + "/hold";
    });

    $('#viewModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let id = button.data('id');
        let reason = button.data('reason');

        $('#viewReason').text(reason);
        document.getElementById('viewSignForm').action =
            "/business-office/clearance-requests/" + id + "/accept";
    });

});
</script>

</x-master-layout>
