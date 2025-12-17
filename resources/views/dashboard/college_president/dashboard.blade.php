<x-master-layout 
    :breadcrumbs="['College President', 'Dashboard']" 
    sidebar="dashboard.college_president.partials.sidebar" 
    navbar="dashboard.college_president.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">
                Welcome, {{ Auth::user()->name ?? 'College President' }}!
            </h2>
            <p class="az-dashboard-text">
                Institutional overview and administrative dashboard.
            </p>
        </div>
    </div>

    <div class="row row-sm mg-b-20">

        <!-- System Overview -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">System Overview</h6>
                    <h3 class="text-primary">Online Clearance</h3>
                    <p class="text-muted">
                        Monitor overall system activity and performance.
                    </p>
                </div>
            </div>
        </div>

        <!-- Academic Oversight -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Academic Oversight</h6>
                    <p class="text-muted">
                        Ensure academic policies and institutional standards
                        are upheld across departments.
                    </p>
                </div>
            </div>
        </div>

        <!-- Administrative Summary -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">Administrative Summary</h6>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Role: <strong>College President</strong>
                        </li>
                        <li class="list-group-item">
                            Access Level: <strong>Final Authority</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</x-master-layout>
