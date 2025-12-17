<x-master-layout
    :breadcrumbs="['Student', 'Marching Clearance']"
    sidebar="dashboard.student.partials.sidebar"
    navbar="dashboard.student.partials.navbar"
>

<h2 class="mb-3">Marching Clearance Activation</h2>

<div class="card">
    <div class="card-body">

        @if ($clearances->isEmpty())
            <p class="text-muted text-center">
                No marching clearance available.
            </p>
        @else
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Clearance</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clearances as $clearance)
                        @php
                            $request = $requests[$clearance->id] ?? null;
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $clearance->title }}</td>

                            <td>
                                @if (!$request)
                                    <span class="badge bg-secondary">
                                        Not Requested
                                    </span>

                                @elseif ($request->status === 'activation_approved')
                                    <span class="badge bg-success">
                                        Activated
                                    </span>

                                @elseif ($request->status === 'pending')
                                    <span class="badge bg-warning text-dark">
                                        Pending Approval
                                    </span>

                                @elseif ($request->status === 'held')
                                    <span class="badge bg-danger">
                                        Held
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{-- ONLY FIRST REQUEST --}}
                                @if (!$request)
                                    <form
                                        action="{{ route('student.clearances.request', $clearance->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            Request Activation
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
