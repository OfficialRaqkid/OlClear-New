<x-master-layout
    :breadcrumbs="['Student', 'Clearances']"
    sidebar="dashboard.student.partials.sidebar"
    navbar="dashboard.student.partials.navbar"
    footer="dashboard.student.partials.footer"
>
    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Clearances</h2>
            <p class="az-dashboard-text">
                Request and track your clearance status.
            </p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">

            @if ($clearances->isEmpty())
                <div class="text-center text-muted py-5">
                    No clearances available at the moment.
                </div>
            @else
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Clearance</th>
                            <th>Description</th>
                            <th>Status / Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clearances as $clearance)
                            @php
                                $student = auth()->user()->studentProfile;

                                $request = $student
                                    ? $student->clearanceRequests()
                                        ->where('clearance_id', $clearance->id)
                                        ->latest()
                                        ->first()
                                    : null;

                                $type = $clearance->clearanceType->name;
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $clearance->title }}</strong><br>
                                    <small class="text-muted">{{ $type }}</small>
                                </td>

                                <td>{{ $clearance->description ?? '—' }}</td>

                                <td>

                                    {{-- 🟢 NO REQUEST --}}
                                    @if (!$request)
                                        <form
                                            action="{{ route('student.clearances.request', $clearance->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                Request
                                            </button>
                                        </form>

                                    {{-- 🎓 MARCHING — ACTIVATED (SECOND CLICK) --}}
                                    @elseif (
                                        $type === 'Marching Clearance' &&
                                        $request->status === 'activation_approved'
                                    )
                                        <form
                                            action="{{ route('student.clearances.request', $clearance->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            <button class="btn btn-primary btn-sm">
                                                Start Marching Clearance
                                            </button>
                                        </form>

                                    {{-- ⏳ PENDING --}}
                                    @elseif ($request->status === 'pending')
                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    {{-- ⛔ HELD --}}
                                    @elseif ($request->status === 'held')
                                        <span class="badge bg-danger">
                                            On Hold
                                        </span>

                                    {{-- 🔄 IN PROGRESS --}}
                                    @elseif ($request->status === 'accepted')
                                        <span class="badge bg-info">
                                            In Progress
                                        </span>

                                    {{-- ✅ COMPLETED --}}
                                    @elseif ($request->status === 'completed')
                                        <span class="badge bg-primary">
                                            Completed
                                        </span>

                                    {{-- 🧩 FALLBACK --}}
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                        </span>
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
