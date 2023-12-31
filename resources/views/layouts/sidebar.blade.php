<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">

        <div class="sidebar-brand-text mx-3">Fasee7</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="far fa-window-maximize" ></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('levels') }}">
            <i class='fas fa-book-open' ></i>
            <span>Levels</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('users') }}">
            <i class='fas fa-users'></i>
            <span>Users</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/profile">
            <i class="far fa-address-card"></i>
            <span>Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
