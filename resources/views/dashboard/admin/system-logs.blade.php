<x-master-layout :breadcrumbs="['Admin', 'System Logs']"
    sidebar="dashboard.admin.partials.sidebar"
    navbar="dashboard.admin.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">System Logs</h2>
            <p class="az-dashboard-text">List of all users and students added to the system.</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Year Level</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->username }}</td>
                            <td>{{ $log->role_name }}</td>
                            <td>{{ $log->department_name ?? '—' }}</td>
                            <td>{{ $log->year_level ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-master-layout>
