<x-master-layout
    :breadcrumbs="['Registrar', 'Marching Clearance', 'Requests']"
    sidebar="dashboard.registrar.partials.sidebar"
    navbar="dashboard.registrar.partials.navbar">

    <h2 class="mb-3">
        Marching Clearance Requests
    </h2>

    <p class="text-muted">
        Clearance: <strong>{{ $clearance->title }}</strong>
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            @if ($requests->isEmpty())
                <p class="text-center text-muted">
                    No student requests found.
                </p>
            @else
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Status</th>
                            <th width="300">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $request->student->first_name }}
                                    {{ $request->student->last_name }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ strtoupper(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                </td>

                                <td>
                                    {{-- ❌ NOT PUBLISHED --}}
                                    @if (!$clearance->is_published)
                                        <span class="text-muted">
                                            Waiting for Admin to Publish
                                        </span>

                                    {{-- 🟡 PENDING --}}
                                    @elseif ($request->status === 'pending')
                                        <form
                                            action="{{ route('registrar.marching.approve', $request) }}"
                                            method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                Approve
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('registrar.marching.hold', $request) }}"
                                            method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                Hold
                                            </button>
                                        </form>

                                    {{-- 🔵 APPROVED --}}
                                    @elseif ($request->status === 'registrar_approved')
                                        <span class="badge bg-info">
                                            Waiting for Student
                                        </span>

                                    {{-- 🔴 HELD --}}
                                    @elseif ($request->status === 'held')
                                        <span class="badge bg-danger">
                                            Held
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
