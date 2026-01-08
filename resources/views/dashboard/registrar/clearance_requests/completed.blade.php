<x-master-layout
    :breadcrumbs="['Registrar', 'Completed Marching Clearances']"
    sidebar="dashboard.registrar.partials.sidebar"
    navbar="dashboard.registrar.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title mb-4">
        <div>
            <h2 class="az-dashboard-title">Completed Marching Clearances</h2>
            <p class="az-dashboard-text">
                List of 4th year students who have fully completed their marching clearance.
            </p>
        </div>
    </div>

    {{-- FILTER FORM (SCHOOL YEAR ONLY) --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-8">
                    <label class="form-label">School Year</label>
                    <input
                        type="text"
                        name="school_year"
                        class="form-control"
                        placeholder="e.g. 2024-2025"
                        value="{{ request('school_year') }}"
                    >
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">
                        Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @php
                // ✅ ONLY COMPLETED MARCHING CLEARANCE (ALL YEAR LEVELS)
                $marchingCompleted = $completedRequests->filter(function ($req) {
                    return $req->status === 'completed'
                        && optional($req->clearance->clearanceType)->name === 'Marching Clearance';
                });
            @endphp

            @if ($marchingCompleted->isEmpty())
                <div class="text-center py-5 text-muted">
                    No completed marching clearances found.
                </div>
            @else
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Program</th>
                            <th>Year Level</th>
                            <th>School Year</th>
                            <th>Status</th>
                            <th>Completed Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marchingCompleted as $key => $req)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ $req->student->first_name ?? 'N/A' }}
                                    {{ $req->student->last_name ?? '' }}
                                </td>
                                <td>{{ $req->student->program->name ?? 'N/A' }}</td>
                                <td>{{ $req->student->yearLevel->name ?? 'N/A' }}</td>
                                <td>{{ $req->clearance->school_year ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-success">Completed</span>
                                </td>
                                <td>
                                    {{ $req->updated_at->format('M d, Y h:i A') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</x-master-layout>
