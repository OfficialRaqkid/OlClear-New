<x-master-layout :breadcrumbs="['College President', 'Student Accounts']"
    sidebar="dashboard.college_president.partials.sidebar"
    navbar="dashboard.college_president.partials.navbar"
    footer="dashboard.student.partials.footer">

<div class="az-dashboard-one-title">
    <div>
        <h2 class="az-dashboard-title">Student Accounts</h2>
        <p class="az-dashboard-text">List of all registered students.</p>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Department</th>
                    <th>Program</th>
                    <th>Year Level</th>
                    <th>Date Added</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                    @php $profile = $student->studentProfile; @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $profile->first_name }} {{ $profile->last_name }}</td>
                        <td>{{ $student->username }}</td>
                        <td>{{ optional($profile->program->department)->name ?? '—' }}</td>
                        <td>{{ optional($profile->program)->name ?? '—' }}</td>
                        <td>{{ optional($profile->yearLevel)->name ?? '—' }}</td>
                        <td>{{ $student->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</x-master-layout>
