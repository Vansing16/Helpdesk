<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: black;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HelpDesk</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- dashboard --}}
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="bi bi-speedometer"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Nav Item - Ticket -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.ticket')}}">
            <i class="bi bi-ticket-detailed-fill"></i>
            <span>Ticket</span></a>
    </li>

    <!-- Nav Item - Agents -->

    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.technical')}}">
            <i class="bi bi-people-fill"></i>
            <span>Agents</span></a>
    </li>

    {{-- user --}}
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.customer')}}">
            <i class="bi bi-person-fill"></i>
            <span>Customer</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

