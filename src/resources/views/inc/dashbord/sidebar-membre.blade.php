<!-- partial:partials/_sidebar.html -->
@php($route = request()->route()->action['as'])
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Acceuil</li>
            <li @class(["nav-item", 'active2' => $route==='membre.home'])>
                <a href="dashboard.html" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Mes prets</li>
            <li @class(["nav-item", 'active2' => $route==='membre.home' || $route==='membre.demande.edit'])>
                <a href="{{ route('membre.home') }}" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Demandes</span>
                </a>
            </li>
            <li @class(["nav-item", 'active2' => $route==='membre.pret.index'])>
                <a href="{{ route('membre.pret.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">En cours de paiement</span>
                </a>
            </li>
            <li @class(["nav-item", 'active2' => $route==='membre.pret.archive'])>
                <a href="{{ route('membre.pret.archive') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Archives</span>
                </a>
            </li>

        </ul>
    </div>
</nav>

<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item" href="admin/demo1/dashboard.html">
                <img src="{{ asset('admin/assets/images/screenshots/light.jpg') }}" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item active" href="admin/demo2/dashboard.html">
                <img src="{{ asset('admin/assets/images/screenshots/dark.jpg') }}" alt="light theme">
            </a>
        </div>
    </div>
</nav>
<!-- partial -->
