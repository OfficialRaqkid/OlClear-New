<x-master-layout 
    :breadcrumbs="['Admin', 'Create Clearance']"
    sidebar="dashboard.admin.partials.sidebar"
    navbar="dashboard.admin.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title mb-3">
        <div>
            <h2 class="az-dashboard-title">Create Clearance</h2>
            <p class="az-dashboard-text">
                Select clearance type and offices.
            </p>
        </div>
    </div>

    <div class="card p-4 shadow-sm border-0 rounded-3">
        <form action="{{ route('admin.clearances.store') }}" method="POST">
            @csrf

            {{-- Clearance Type --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-primary">Clearance Type</label>
                <select
                    name="clearance_type_id"
                    id="clearanceType"
                    class="form-select form-select-lg border-primary shadow-sm"
                    required
                >
                    <option value="">-- Select Clearance Type --</option>
                    @foreach ($clearanceTypes as $type)
                        <option value="{{ $type->id }}" data-name="{{ $type->name }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Clearance Title (AUTO & LOCKED) --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-primary">Clearance Title</label>
                <input
                    type="text"
                    id="clearanceTitle"
                    name="title"
                    class="form-control form-control-lg border-primary shadow-sm"
                    readonly
                    required
                >
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-primary">Description</label>
                <textarea
                    name="description"
                    class="form-control border-primary shadow-sm"
                    rows="3"
                ></textarea>
            </div>

            {{-- Offices --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-primary">
                    Offices Handling the Clearance
                </label>

                <select
                    name="offices[]"
                    class="form-select form-select-lg border-primary shadow-sm"
                    multiple
                    required
                >
                    <option value="library_in_charge">📚 Library In-Charge</option>
                    <option value="dean">🎓 Dean</option>
                    <option value="registrar">📝 Registrar</option>
                    <option value="vp_academic">🏫 VP Academic</option>
                    <option value="vp_sas">🏛️ VP SAS</option>
                    <option value="business_office">💼 Business Office</option>
                    <option value="college_president">👔 College President</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">
                💾 Save Clearance
            </button>
        </form>
    </div>

    {{-- FIXED AUTO-FILL --}}
    <script>
        document.getElementById('clearanceType').addEventListener('change', function () {
            const option = this.options[this.selectedIndex];
            const name = option.getAttribute('data-name');

            // ✅ EXACT NAME ONLY (NO DUPLICATE)
            document.getElementById('clearanceTitle').value = name || '';
        });
    </script>

</x-master-layout>
