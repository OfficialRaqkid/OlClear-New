<x-master-layout :breadcrumbs="['Admin', 'Dashboard']" 
    sidebar="dashboard.admin.partials.sidebar" 
    navbar="dashboard.admin.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">
                Welcome, {{ Auth::user()->name ?? 'Admin' }}!
            </h2>
            <p class="az-dashboard-text">Here’s an overview of the clearance system metrics and administration.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">System Settings</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- User Accounts -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Active Users</h6>
                    <h3 class="text-primary">145 Users</h3>
                    <p class="text-muted">Including students and staff</p>
                    <!-- Trigger Modal -->
                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Manage Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Clearance Templates -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Clearance Types</h6>
                    <h3 class="text-info">4 Workflows</h3>
                    <p class="text-muted">Marching, Financial, Release, Department</p>
                    <a href="" class="btn btn-sm btn-outline-info">Edit Workflows</a>
                </div>
            </div>
        </div>

        <!-- Logs -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">Recent Logs</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Login Events: <strong>350</strong></li>
                        <li class="list-group-item">Changes Made: <strong>75</strong></li>
                        <li class="list-group-item">New Accounts: <strong>22</strong></li>
                    </ul>
                    <a href="" class="btn btn-sm btn-outline-secondary mt-2">View Logs</a>
                </div>
            </div>
        </div>
    </div>


    <!-- 🔽 Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>

                        <!-- Role -->
                        <div class="col-md-6 mb-3">
                            <label for="role_id">Role</label>
                            <select class="form-control" name="role_id" id="role_id" required>
                                <option value="">-- Select Role --</option>
                                <option value="2">Library In-Charge</option>
                                <option value="3">Dean</option>
                                <option value="4">VP SAS</option>
                                <option value="5">Business Office</option>
                            </select>
                        </div>

                        <!-- Department (Only if Dean) -->
                        <div class="col-md-6 mb-3" id="departmentField" style="display:none;">
                            <label for="department_id">Department (Dean Only)</label>
                            <select class="form-control" name="department_id" id="department_id">
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }} ({{ $department->abbreviation }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" required>
                        </div>

                        <!-- Middle Name -->
                        <div class="col-md-6 mb-3">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" id="middle_name">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" required>
                        </div>

                        <!-- Suffix -->
                        <div class="col-md-6 mb-3">
                            <label for="suffix">Suffix</label>
                            <input type="text" class="form-control" name="suffix" id="suffix" placeholder="Jr., Sr., III">
                        </div>

                        <!-- Academic Title -->
                        <div class="col-md-6 mb-3">
                            <label for="academic_title">Academic Title</label>
                            <input type="text" class="form-control" name="academic_title" id="academic_title" placeholder="Prof., Dr., etc.">
                        </div>

                        <!-- Profile Photo -->
                        <div class="col-md-6 mb-3">
                            <label for="profile_photo">Profile Photo URL</label>
                            <input type="text" class="form-control" name="profile_photo" id="profile_photo" placeholder="http://...">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role_id');
    const departmentField = document.getElementById('departmentField');

    roleSelect.addEventListener('change', function () {
        if (this.value == '3') { // Dean
            departmentField.style.display = 'block';
        } else {
            departmentField.style.display = 'none';
        }
    });
});
</script>
</x-master-layout>
