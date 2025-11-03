<x-master-layout 
    :breadcrumbs="['Admin', 'Create Clearance']"
    sidebar="dashboard.admin.partials.sidebar"
    navbar="dashboard.admin.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title mb-3">
        <div>
            <h2 class="az-dashboard-title">Create Clearance Form</h2>
            <p class="az-dashboard-text">Select the clearance type, assign offices, and publish the clearance flow.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 shadow-sm border-0 rounded-3">
        <form action="{{ route('admin.clearances.store') }}" method="POST">
            @csrf

            {{-- ✅ Clearance Type Dropdown --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-primary">Clearance Type</label>
                <select name="clearance_type_id" id="clearanceType" class="form-select form-select-lg border-primary shadow-sm" required>
                    <option value="">-- Select Clearance Type --</option>
                    @foreach ($clearanceTypes as $type)
                        <option value="{{ $type->id }}" data-name="{{ $type->name }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Selecting a clearance type will automatically fill the title below.</small>
            </div>

            {{-- Clearance Title (auto-filled from type) --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-primary">Clearance Title</label>
                <input type="text" id="clearanceTitle" name="title" class="form-control form-control-lg border-primary shadow-sm" placeholder="e.g. Financial Clearance" required>
            </div>

            {{-- Clearance Description --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-primary">Description</label>
                <textarea name="description" class="form-control border-primary shadow-sm" rows="3" placeholder="Provide a short description..."></textarea>
            </div>

            {{-- Office Selection --}}
            <h5 class="fw-bold text-primary mb-3 mt-4">Offices Handling the Clearance</h5>
            <p class="text-muted mb-3">Select which offices will handle this clearance in order:</p>

            <ol class="list-group list-group-numbered border-0">
                <li class="list-group-item border-0">
                    <div class="form-check">
                        <input class="form-check-input me-2" type="checkbox" name="offices[]" value="library_in_charge" id="libraryCheck">
                        <label class="form-check-label" for="libraryCheck">
                            📚 Library In-Charge .
                        </label>
                    </div>
                </li>

                <li class="list-group-item border-0">
                    <div class="form-check">
                        <input class="form-check-input me-2" type="checkbox" name="offices[]" value="dean" id="deanCheck">
                        <label class="form-check-label" for="deanCheck">
                            🎓 Dean 
                        </label>
                    </div>
                </li>

                <li class="list-group-item border-0">
                    <div class="form-check">
                        <input class="form-check-input me-2" type="checkbox" name="offices[]" value="vp_sas" id="vpSasCheck">
                        <label class="form-check-label" for="vpSasCheck">
                            🏛️ VP SAS 
                        </label>
                    </div>
                </li>

                <li class="list-group-item border-0">
                    <div class="form-check">
                        <input class="form-check-input me-2" type="checkbox" name="offices[]" value="business_office" id="businessCheck">
                        <label class="form-check-label" for="businessCheck">
                            💼 Business Office 
                        </label>
                    </div>
                </li>
            </ol>

            {{-- Publish Option --}}
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" name="is_published" id="publishCheck">
                <label class="form-check-label fw-bold text-primary" for="publishCheck">Publish this clearance immediately</label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary mt-4 px-5 py-2 rounded-pill shadow-sm">
                💾 Save Clearance
            </button>
        </form>
    </div>

    {{-- ✅ Auto-fill JS --}}
    <script>
        document.getElementById('clearanceType').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const typeName = selectedOption.getAttribute('data-name');
            document.getElementById('clearanceTitle').value = typeName ? typeName + ' Clearance' : '';
        });
    </script>

</x-master-layout>
