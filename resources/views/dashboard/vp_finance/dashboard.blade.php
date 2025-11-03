<x-master-layout :breadcrumbs="['VP - Finance', 'Dashboard']" sidebar="dashboard.vp_finance.partials.sidebar"
    navbar="dashboard.vp_finance.partials.navbar" footer="dashboard.student.partials.footer">
    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Welcome, !</h2>
            <p class="az-dashboard-text">Overview of pending financial clearances and accounts.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">Review Requests</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- Pending Financial Clearances -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Pending Clearances</h6>
                    <h3 class="text-warning">15 Requests</h3>
                    <p class="text-muted">Students waiting for financial sign-off</p>
                    <a href="" class="btn btn-sm btn-outline-primary">Approve</a>
                </div>
            </div>
        </div>

        <!-- Outstanding Balances -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Outstanding Balances</h6>
                    <h3 class="text-danger">₱ 512,000</h3>
                    <p class="text-muted">Total unpaid balances</p>
                    <a href="" class="btn btn-sm btn-outline-danger">View Accounts</a>
                </div>
            </div>
        </div>

        <!-- Monthly Activity Summary -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">This Month</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Approved Clearances: <strong>48</strong></li>
                        <li class="list-group-item">T.O.R. Requested: <strong>12</strong></li>
                        <li class="list-group-item">Total Active Accounts: <strong>1,072</strong></li>
                    </ul>
                    <a href="" class="btn btn-sm btn-outline-secondary mt-2">Generate Report</a>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
