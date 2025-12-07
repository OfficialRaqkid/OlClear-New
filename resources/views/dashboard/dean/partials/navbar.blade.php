<div class="az-header">
    <div class="container">
        <div class="az-header-left">
            <a href="" class="az-logo"><span></span> iClear</a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div>

        <div class="az-header-menu">
            <ul class="nav">
                <li class="nav-item active">
                    <a href="" class="nav-link">
                        <i class="typcn typcn-home-outline"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dean.clearance_requests.index') }}"  class="nav-link">
                        <i class="typcn typcn-document-add"></i> Sign Requests
                    </a>
                </li>
                                <li class="nav-item">
                    <a href="{{ route('dean.clearances.index') }}"  class="nav-link">
                        <i class="typcn typcn-folder"></i> Manage Clearances
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="typcn typcn-time"></i> Clearance History
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="typcn typcn-chart-bar-outline"></i> Department Reports
                    </a>
                </li>
            </ul>
        </div>

        <div class="az-header-right">
            <div class="az-header-message">
                <a href="#"><i class="typcn typcn-messages"></i></a>
            </div>
            <div class="dropdown az-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
            </div>
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="{{ asset('img/faces/face1.jpg') }}" alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user"><img src="{{ asset('img/faces/face1.jpg') }}" alt=""></div>
                        <h6></h6>
                        <span>Dean / Chairperson</span>
                    </div>
                    <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="{{ route('logout.admin') }}" class="dropdown-item"
    onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
    <i class="typcn typcn-power-outline"></i> Sign Out
</a>

<form id="logout-form-admin" action="{{ route('logout.admin') }}" method="POST" class="d-none">
    @csrf
</form>
                </div>
            </div>
        </div>
    </div>
</div>
