<x-master-layout :breadcrumbs="['VP - Academic Affairs', 'Dashboard']" sidebar="dashboard.vp_academic.partials.sidebar"
    navbar="dashboard.vp_academic.partials.navbar" footer="dashboard.student.partials.footer">
    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Welcome, !</h2>
            <p class="az-dashboard-text">Review and attest clearances approved by Registrar.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">Attest Now</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- Pending Attestations -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Pending Attestations</h6>
                    <h3 class="text-warning">6 Clearances</h3>
                    <p class="text-muted">Waiting for your final signature</p>
                    <a href="" class="btn btn-sm btn-outline-primary">View</a>
                </div>
            </div>
        </div>

        <!-- Activity Summary -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Clearances Reviewed</h6>
                    <h3 class="text-success">89 Total</h3>
                    <p class="text-muted">All-time record</p>
                    <a href="" class="btn btn-sm btn-outline-success">Logs</a>
                </div>
            </div>
        </div>

        <!-- Month Summary -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">This Month</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Attested: <strong>23</strong></li>
                        <li class="list-group-item">Returned: <strong>3</strong></li>
                        <li class="list-group-item">Awaiting Registrar: <strong>5</strong></li>
                    </ul>
                    <a href="" class="btn btn-sm btn-outline-secondary mt-2">View Details</a>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
