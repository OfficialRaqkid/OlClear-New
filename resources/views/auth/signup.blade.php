<x-auth-layout>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4" style="max-width: 600px; width: 100%;">
            <h1 class="text-primary text-center font-weight-bold mb-4">
                <span class="text-info">i</span>Clear
            </h1>

                <form action="{{ route('register.student.submit') }}" method="POST">
                @csrf

                <!-- Student ID -->
                <div class="form-group">
                    <label for="contact_number">Student ID*</label>
                    <input type="text" name="student_id" class="form-control" placeholder="e.g., 1162XXXXXXX">
                </div>

                <!-- Full Name -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">First Name*</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name*</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="suffix">Suffix</label>
                        <input type="text" name="suffix" class="form-control" placeholder="e.g., Jr., III">
                    </div>
                </div>

                <!-- Program and Year Level -->
                            <div class="form-group">
                <label for="department_id">Department*</label>
                <select name="department_id" class="form-control" required>
                    <option value="" disabled selected>Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="program_id">Program*</label>
                        <select name="program_id" class="form-control" required>
                            <option value="" disabled selected>Select Program</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="year_level_id">Year Level*</label>
                        <select name="year_level_id" class="form-control" required>
                            <option value="" disabled selected>Select Year Level</option>
                            @foreach ($yearLevels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="form-group">
                    <label for="contact_number">Contact Number*</label>
                    <input type="text" name="contact_number" class="form-control" placeholder="e.g., 0917XXXXXXX">
                </div>

                <div class="form-group">
                    <label for="address">Home Address*</label>
                    <textarea name="address" class="form-control" placeholder="Street, City, Province" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>

            <div class="text-center mt-3">
                <small>Already have an account?
                    <a href="{{ route('login.student') }}" class="font-weight-bold text-primary">Sign In</a>
                </small>
            </div>
        </div>
    </div>
</x-auth-layout>
