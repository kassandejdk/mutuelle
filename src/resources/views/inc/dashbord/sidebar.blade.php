@php($route = request()->route()->action['as'])
<!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
            Gest<span>Mutuelle</span>
            </a>
            <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
            </div>
        </div>
        <div class="sidebar-body">

            <ul class="nav">
                <li class="nav-item nav-category">Mes actions</li>
                <li class="nav-item">
                    <a href="{{ route('dashbord.dashbord') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Gestion des membres</li>
                <li  @class(["nav-item", 'active2' => $route==='dashbord.dashbord'])>
                    <a class="nav-link" href="{{ route('dashbord.dashbord') }}" >
                        <i class="link-icon" data-feather="folder"></i>
                        <span class="link-title">Demandes d'inscription</span>
                    </a>
                </li>
                <li  @class(["nav-item", 'active2' => $route==='liste.membre'])>
                    <a href="{{ route('liste.membre') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Liste des membres</span>
                    </a>
                </li>
                <li @class(["nav-item", 'active2' => $route==='membre.bannit'])>
                    <a href="{{ route('membre.bannit') }}" class="nav-link">
                    <i class="link-icon" data-feather="user-x"></i>
                    <span class="link-title">Membres bannits</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Gestion des Prêts</li>
                <li @class(["nav-item", 'active2' => $route==='voir.demande'])>
                    <a href="{{ route('voir.demande') }}" class="nav-link">
                    <i class="link-icon" data-feather="credit-card"></i>
                    <span class="link-title">Demandes de prêts</span>
                    </a>
                </li>
                <li @class(["nav-item", 'active2' => $route==='pret.run'])>
                    <a href="{{ route('pret.run') }}" class="nav-link">
                    <i class="link-icon" data-feather="credit-card"></i>
                    <span class="link-title">Les prêts en cours</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Gestion financieres</li>
                <li @class(["nav-item", 'active2' => $route==='rapport.financier'])>
                    <a href="{{ route('rapport.financier') }}" class="nav-link">
                    <i class="link-icon" data-feather="credit-card"></i>
                    <span class="link-title">Rapports financiers</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Gestion Commentaire</li>
                <li @class(["nav-item", 'active2' => $route==='voir.commentaire'])>
                    <a href="{{ route('voir.commentaire') }}" class="nav-link">
                    <i class="link-icon" data-feather="credit-card"></i>
                    <span class="link-title">Les commentaires</span>
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