<nav class="sidebar sidebar-bunker">
    <div class="sidebar-header">
        <!--<a href="index.html" class="logo"><span>bd</span>task</a>-->
        <a href="index.html" class="logo"><img src="{{ asset('assets/dist/img/logo.png') }}" alt=""></a>
    </div><!--/.sidebar header-->
    <div class="profile-element d-flex align-items-center flex-shrink-0">
        <div class="avatar online">
            <img src="{{ asset('assets/dist/img/avatar-1.jpg') }}" class="img-fluid rounded-circle" alt="">
        </div>
        <div class="profile-text">
            <h6 class="m-0">{{ auth()->user()->name }}</h6>
            <span>{{ auth()->user()->email }}</span>
        </div>
    </div><!--/.profile element-->
    <form class="search sidebar-form" action="#" method="get">
        <div class="search__inner">
            <input type="text" class="search__text" placeholder="Search...">
            <i class="typcn typcn-zoom-outline search__helper" data-sa-action="search-close"></i>
        </div>
    </form><!--/.search-->
    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                <li class="nav-label">Main Menu</li>
                <li>
                    <a class="" href="/">
                        <i class="typcn typcn-home-outline mr-2"></i>
                        Dashboard
                    </a>
                    <!-- <ul class="nav-second-level">
                        <li ><a href="index.html">Default</a></li>
                        <li><a href="dashboard_two.html">Dashboard Two</a></li>
                    </ul> -->
                </li>
                <li><a href="{{ route('academic_session.index') }}"><i class="typcn typcn-messages mr-2"></i>Academic
                        Session</a></li>
                <li><a href="{{ route('admin.school-fees') }}"><i class="typcn typcn-messages mr-2"></i>Manage School
                        Fees</a></li>
                <li><a href="{{ route('academic_session.index') }}"><i class="typcn typcn-messages mr-2"></i>Manage
                        Invoices</a></li>
                <li><a href="{{ route('academic_session.index') }}"><i class="typcn typcn-messages mr-2"></i>Manage
                        Payment</a></li>


                <li class="{{ Route::currentRouteName() === 'admin.student.index' ? 'mm-active' : '' }}"><a
                        href="{{ route('admin.student.index') }}"><i class="typcn typcn-messages mr-2"></i>Manage
                        Students</a></li>
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-mail mr-2"></i>
                        Manage Classes
                    </a>
                    <ul class="nav-second-level">
                        <li class="{{ Route::currentRouteName() === 'admin.class.index' ? 'mm-active' : '' }}"><a
                                href="{{ route('admin.class.index') }}">Classes</a></li>
                        <li class="{{ Route::currentRouteName() === 'admin.subclass.index' ? 'mm-active' : '' }}"><a
                                href="{{ route('admin.subclass.index') }}">Sub Classes</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-archive mr-2"></i>
                        Manage Report
                    </a>
                    <ul class="nav-second-level">
                        <li><a href="#">Termly Report</a></li>
                        <li><a href="">Session report</a></li>
                        <li><a href="">Payment Report</a></li>
                        <li><a href="">Outstanding Report</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div><!-- sidebar-body -->
</nav>
