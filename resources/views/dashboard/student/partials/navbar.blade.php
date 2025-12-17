<div class="az-header"> 
    <div class="container">
        <div class="az-header-left">
            <a href="#" class="az-logo"><span></span> iClear</a>
            <a href="#" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div>

        <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="#" class="az-logo"><span></span> iClear</a>
                <a href="#" class="close">&times;</a>
            </div>
            <ul class="nav">
                <li class="nav-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('student.dashboard') }}"  class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item {{ request()->routeIs('student.clearances.marching') ? 'active' : '' }}">
                <a href="{{ route('student.clearances.marching') }}" class="nav-link">
                    <i class="typcn typcn-clipboard"></i>
                    Request Clearance
                </a>
            </li>
                <li class="nav-item {{ request()->routeIs('student.clearances.index') ? 'active' : '' }}">
                    <a href="{{ route('student.clearances.index') }}"  class="nav-link"><i class="typcn typcn-document-text"></i> My Clearances</a>
                </li>
            </ul>
        </div>

        <div class="az-header-right">
            <div class="az-header-message">
                <a href="#"><i class="typcn typcn-messages"></i></a>
            </div>

            <div class="dropdown az-header-notification">
                <a href="#" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <h6 class="az-notification-title">Notifications</h6>
                    <p class="az-notification-text">You have 2 new notifications</p>
                    <div class="az-notification-list">
                        <!-- Example Notification -->
                        <div class="media new">

<div class="az-img-user">
    <img 
        src="{{ $student && $student->profile_photo 
                ? asset('storage/' . $student->profile_photo) 
                : asset('img/faces/default.jpg') }}" 
        alt="Profile Photo"
        onerror="this.src='{{ asset('img/faces/default.jpg') }}';">
</div>>

                            <div class="media-body">
                                <p><strong>Registrar</strong> approved your clearance request</p>
                                <span>Today, 3:00 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer"><a href="#">View All Notifications</a></div>
                </div>
            </div>

            {{-- 🔹 Student Profile Dropdown --}}
@php
    $student = Auth::check() ? Auth::user()->studentProfile : null;
@endphp

            <div class="dropdown az-profile-menu">
                <a href="#" class="az-img-user">
<img 
    src="{{ $student && $student->profile_photo 
            ? asset('storage/' . $student->profile_photo) 
            : asset('img/faces/default.jpg') }}" 
    alt="Profile Photo"
    onerror="this.src='{{ asset('img/faces/default.jpg') }}';">
                </a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
<img 
    src="{{ $student && $student->profile_photo 
            ? asset('storage/' . $student->profile_photo) 
            : asset('img/faces/default.jpg') }}" 
    alt="Profile Photo"
    onerror="this.src='{{ asset('img/faces/default.jpg') }}';">
                        </div>
                        <h6>{{ $student ? $student->first_name . ' ' . $student->last_name : 'Student' }}</h6>
                        <span>Student</span>
                    </div>

                    <a href="{{ route('student.profile') }}" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>

                    <a href="{{ route('student.logout') }}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="typcn typcn-power-outline"></i> Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
