<x-master-layout 
    :breadcrumbs="['Admin', 'Clearance Types']"
    sidebar="dashboard.admin.partials.sidebar"
    navbar="dashboard.admin.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Clearance Types</h2>
            <p class="az-dashboard-text">List of all created clearances in the system.</p>
        </div>
        <a href="{{ route('admin.clearances.create') }}" class="btn btn-primary">
            <i class="typcn typcn-plus"></i> Create New Clearance
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="card mt-3 shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Clearance Type</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Offices</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clearances as $clearance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- ✅ Show Clearance Type --}}
                            <td>{{ $clearance->clearanceType->name ?? '—' }}</td>

                            {{-- ✅ Show Title --}}
                            <td>{{ $clearance->title }}</td>

                            {{-- ✅ Description --}}
                            <td>{{ $clearance->description ?? '—' }}</td>

                            {{-- ✅ Offices --}}
                            <td>
                                @if ($clearance->offices)
                                    @foreach ($clearance->offices as $office)
                                        <span class="badge bg-secondary text-uppercase me-1">
                                            {{ str_replace('_', ' ', $office) }}
                                        </span>
                                    @endforeach
                                @else
                                    <em class="text-muted">None</em>
                                @endif
                            </td>

                            {{-- ✅ Publish Status --}}
                            <td>
                                @if ($clearance->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>

                            {{-- ✅ Created Date --}}
                            <td>{{ $clearance->created_at->format('M d, Y h:i A') }}</td>

                            {{-- ✅ Publish Action --}}
                            <td>
                                @if (!$clearance->is_published)
                                    <form action="{{ route('admin.clearances.publish', $clearance->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit">
                                            <i class="typcn typcn-upload"></i> Publish
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No clearances found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-master-layout>
