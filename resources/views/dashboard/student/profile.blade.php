<x-master-layout :breadcrumbs="['Student', 'Profile']"
    sidebar="dashboard.student.partials.sidebar"
    navbar="dashboard.student.partials.navbar"
    footer="dashboard.student.partials.footer">

    @php
        $student = $student ?? auth()->user()->studentProfile ?? null;
    @endphp

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">My Profile</h2>
            <p class="az-dashboard-text">View and manage your profile information.</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4 text-center">
            <div class="card p-3">
                <img src="{{ $student && $student->profile_photo 
                            ? asset('storage/'.$student->profile_photo) 
                            : asset('img/faces/default.jpg') }}" 
                     alt="Profile Photo" 
                     class="rounded-circle mb-3" width="150" height="150">

                <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="profile_photo" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-2">Change Photo</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-3">
                <h5 class="mb-3">Student Information</h5>
                <p><strong>Name:</strong> {{ $student ? ($student->first_name . ' ' . $student->last_name) : 'N/A' }}</p>
                <p><strong>Student ID:</strong> {{ auth()->user()->username }}</p>
                <p><strong>Department:</strong> {{ optional(optional($student)->program->department)->name ?? 'N/A' }}</p>
                <p><strong>Program:</strong> {{ optional(optional($student)->program)->name ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

</x-master-layout>
