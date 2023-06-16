<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Controle de Estoque - Dashboard</title>

    <link href="{{ asset('backend/img/logo/logo.png') }}" rel="icon">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="app">

        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon">
                        <img src="{{ asset('backend/img/logo/logo2.png') }}">
                    </div>
                    <div class="sidebar-brand-text mx-3">Controle de Estoque</div>
                </a>
                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Features
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                        aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Bootstrap UI</span>
                    </a>
                    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Bootstrap UI</h6>
                            <a class="collapse-item" href="alerts.html">Alerts</a>
                            <a class="collapse-item" href="buttons.html">Buttons</a>
                            <a class="collapse-item" href="dropdowns.html">Dropdowns</a>
                            <a class="collapse-item" href="modals.html">Modals</a>
                            <a class="collapse-item" href="popovers.html">Popovers</a>
                            <a class="collapse-item" href="progress-bar.html">Progress Bars</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms.html">
                        <i class="fab fa-fw fa-wpforms"></i>
                        <span>Forms</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
                        aria-expanded="true" aria-controls="collapseTable">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tables</span>
                    </a>
                    <div id="collapseTable" class="collapse" aria-labelledby="headingTable"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Tables</h6>
                            <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
                            <a class="collapse-item" href="datatables.html">DataTables</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-colors.html">
                        <i class="fas fa-fw fa-palette"></i>
                        <span>UI Colors</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Examples
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                        aria-expanded="true" aria-controls="collapsePage">
                        <i class="fas fa-fw fa-columns"></i>
                        <span>Pages</span>
                    </a>
                    <div id="collapsePage" class="collapse" aria-labelledby="headingPage"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Example Pages</h6>
                            <a class="collapse-item" href="login.html">Login</a>
                            <a class="collapse-item" href="register.html">Register</a>
                            <a class="collapse-item" href="404.html">404 Page</a>
                            <a class="collapse-item" href="blank.html">Blank Page</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Charts</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="version" id="version-ruangadmin"></div>
            </ul>
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->
                    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" id="topbar">
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="img-profile rounded-circle" src="{{ asset('backend/img/boy.png') }}"
                                        style="max-width: 60px">
                                    <router-link to="/logout" class="ml-2 d-none d-lg-inline text-white small"
                                    v-if="$route.path === '/login' || $route.path === '/register' || $route.path === '/forget' ? false : true "
                                    style="display: none;">
                                        Logout
                                    </router-link>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="login.html">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- Topbar -->


                    <!-- Container Fluid-->
                    <div class="container-fluid" id="container-wrapper">
                        <router-view></router-view>
                    </div>
                    <!---Container Fluid-->

                </div>


                <!-- Footer -->
                <footer class="sticky-footer mt-auto bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            Sistema de Controle de Estoque
                            <span>&copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                 {{-- - desenvolvido por <b><a href="https://buchalla.dev" target="_blank">Guilherme B. Ferreira</a></b> --}}
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- Footer -->

            </div>
        </div>
    </div>


    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('backend/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>

</body>

</html>
