<x-master-layout  
    :breadcrumbs="['Business Office', 'Completed Clearances']"
    sidebar="dashboard.business_office.partials.sidebar"
    navbar="dashboard.business_office.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title mb-4">
        <div>
            <h2 class="az-dashboard-title">Completed Student Clearances</h2>
            <p class="az-dashboard-text">
                View students whose clearances have been fully signed and completed.
            </p>
        </div>
    </div>

    {{-- FILTER FORM --}}
    <form method="GET" class="row g-3 align-items-end">

    <div class="col-md-4">
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
        <label class="form-label">Semester</label>
        <select name="semester" class="form-select">
            <option value="">All Semesters</option>
            <option value="1st" {{ request('semester') == '1st' ? 'selected' : '' }}>1st Semester</option>
            <option value="2nd" {{ request('semester') == '2nd' ? 'selected' : '' }}>2nd Semester</option>
            <option value="Summer" {{ request('semester') == 'Summer' ? 'selected' : '' }}>Summer</option>
        </select>
    </div>

    <div class="col-md-12">
        <button class="btn btn-success w-100 mt-2">
            Filter Completed Students
        </button>
    </div>
</form>
        </div>
    </div>

    {{-- TABLE --}}
        <div class="card shadow-sm border-0">
        <div class="card-body p-0">
@php
    $financialCompleted = $completedRequests->filter(function ($req) {
        return optional($req->clearance->clearanceType)->name === 'Financial Clearance';
    });
@endphp

@if ($financialCompleted->isEmpty())
    <div class="text-center py-5 text-muted">
        No completed financial clearances found.
    </div>
@else
<table class="table table-hover align-middle mb-0">
    <thead class="table-success">
        <tr>
            <th>Student Name</th>
            <th>Department</th>
            <th>Year Level</th>
            <th>Clearance Type</th>
            <th>School Year</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Completed Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($financialCompleted as $req)
            <tr>
                <td>{{ $req->student->first_name }} {{ $req->student->last_name }}</td>
                <td>{{ $req->student->program->department->name }}</td>
                <td>{{ $req->student->yearLevel->name }}</td>
                <td>{{ $req->clearance->clearanceType->name }}</td>
                <td>{{ $req->clearance->school_year }}</td>
                <td>{{ $req->clearance->semester }}</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td>{{ $req->updated_at->format('M d, Y h:i A') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
        </div>
    </div>

</x-master-layout>
