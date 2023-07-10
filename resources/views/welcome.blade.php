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

                <router-link :to="{name: 'home'}" class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon">
                        <img src="{{ asset('backend/img/logo/logo2.png') }}">
                    </div>
                    <div class="sidebar-brand-text mx-3">Controle de Estoque</div>
                </router-link>

                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <router-link :to="{name: 'home'}" class="nav-link">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'pos'}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Caixa - Registro de Ordens</span>
                    </router-link>
                </li>

                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Features
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployees"
                        aria-expanded="true" aria-controls="collapseEmployees">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Funcionários</span>
                    </a>
                    <div id="collapseEmployees" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="mt-2 bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Funcionários</h6>
                            <router-link class="collapse-item" to="/employees/create">Cadastrar funcionário
                            </router-link>
                            <router-link class="collapse-item" to="/employees">Lista de funcionários</router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuppliers"
                        aria-expanded="true" aria-controls="collapseSuppliers">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Fornecedores</span>
                    </a>
                    <div id="collapseSuppliers" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="mt-2 bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Fornecedores</h6>
                            <router-link class="collapse-item" to="/suppliers/create">Cadastrar fornecedor</router-link>
                            <router-link class="collapse-item" to="/suppliers">Lista de fornecedores</router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Categorias</span>
                    </a>
                    <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="mt-2 bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Categorias</h6>
                            <router-link class="collapse-item" to="/categories/create">Cadastrar categoria</router-link>
                            <router-link class="collapse-item" to="/categories">Lista de categorias</router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseBootstrap3" aria-expanded="true" aria-controls="collapseBootstrap3">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Produtos</span>
                    </a>
                    <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="mt-2 bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Produtos</h6>
                            <router-link class="collapse-item" to="/products/create">Cadastrar produto</router-link>
                            <router-link class="collapse-item" to="/products">Lista de produtos</router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseBootstrap4" aria-expanded="true" aria-controls="collapseBootstrap4">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Despesas</span>
                    </a>
                    <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="mt-2 bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Despesas</h6>
                            <router-link class="collapse-item" to="/expenses/create">Cadastrar despesa</router-link>
                            <router-link class="collapse-item" to="/expenses">Lista de despesas</router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseBootstrap44" aria-expanded="true" aria-controls="collapseBootstrap44">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Clientes</span>
                    </a>
                    <div id="collapseBootstrap44" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="mt-2 bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Clientes</h6>
                            <router-link class="collapse-item" to="/customers/create">Cadastrar cliente</router-link>
                            <router-link class="collapse-item" to="/customers">Lista de clientes</router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseBootstrap5" aria-expanded="true" aria-controls="collapseBootstrap5">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Salários</span>
                    </a>
                    <div id="collapseBootstrap5" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="mt-2 bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pagamento de Salário</h6>
                            <router-link class="collapse-item" to="/salaries/employees">
                                <span class="text-wrap text-break">Registrar pagamento de salário</span>
                            </router-link>
                            <router-link class="collapse-item" to="/salaries">
                                <span class="text-wrap text-break">Lista de salários pagos por mês</span>
                            </router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseBootstrap51" aria-expanded="true" aria-controls="collapseBootstrap51">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Ordens</span>
                    </a>
                    <div id="collapseBootstrap51" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Ordens</h6>
                            <router-link class="collapse-item" :to="{name: 'orders-today'}">Ordens do dia</router-link>
                            <router-link class="collapse-item" :to="{name: 'orders-search'}">Pesquisar ordem</router-link>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <router-link class="nav-link" to="/stock">
                        <i class="fab fa-fw fa-wpforms"></i>
                        <span>Estoque de produtos</span>
                    </router-link>
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
                        <ul class="navbar-nav ml-auto" 
                            v-if="$route.path === '/login' || $route.path === '/register' || $route.path === '/forget' ? false : true">
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow" >
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="img-profile rounded-circle" src="{{ asset('backend/img/boy.png') }}"
                                        style="max-width: 60px">
                                    <router-link to="/logout" class="ml-2 d-lg-inline text-white small"
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
                <footer-component></footer-component>
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
    {{-- <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script> --}}

</body>

</html>
