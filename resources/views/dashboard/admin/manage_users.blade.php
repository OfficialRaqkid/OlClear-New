<x-master-layout :breadcrumbs="['Admin', 'Manage Users']"
    sidebar="dashboard.admin.partials.sidebar"
    navbar="dashboard.admin.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Manage Users</h2>
            <p class="az-dashboard-text">Add and manage system users</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Role</label>
                        <select class="form-control" name="role_id" id="role_id" required>
                            <option value="">-- Select Role --</option>
                            <option value="2">Library In-Charge</option>
                            <option value="3">Dean</option>
                            <option value="4">VP SAS</option>
                            <option value="5">Business Office</option>
                            <option value="7">Registrar</option>
                            <option value="8">VP Academic Affairs</option>
                            <option value="9">College President</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="departmentField" style="display:none;">
                        <label>Department (Dean Only)</label>
                        <select class="form-control" name="department_id">
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }} ({{ $department->abbreviation }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="middle_name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Suffix</label>
                        <input type="text" class="form-control" name="suffix">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Academic Title</label>
                        <input type="text" class="form-control" name="academic_title">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Profile Photo URL</label>
                        <input type="text" class="form-control" name="profile_photo">
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Save User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role_id');
            const departmentField = document.getElementById('departmentField');

            roleSelect.addEventListener('change', function () {
                departmentField.style.display = this.value == '3' ? 'block' : 'none';
            });
        });
    </script>

</x-master-layout>
