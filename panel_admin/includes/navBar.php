<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Panel Administrativo</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <img style="width:40px"src="images/icono.png" alt="">
            <!-- Navbar-->
            <ul class="navbar-nav  ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <h5 class="text-kmisetas mx-auto"><?php 
                date_default_timezone_set('America/Bogota');
                echo($_SESSION['nombre'])."  |  ". ($_SESSION['rol'])?></h5>
                <li class="nav-item dropdown ml-3">
                    <a class="text-kmisetas-hover dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Configuración</a>
                        <a class="dropdown-item" href="#">Actividades</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../db/logout.php">Salir</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                           <!--  <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link text-kmisetas-hover" href="index.php">
                                <div class="sb-nav-link-icon text-kmisetas-hover"><i class="fas fa-tachometer-alt text-kmisetas-hover"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-kmisetas-hover"><i class="far fa-calendar-alt"></i></div>
                                Pedidos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-kmisetas-hover" href="formIngresarPedido.php">Ingreso Pedidos</a>
                                    <a class="nav-link text-kmisetas-hover" href="listaPedidos.php">Lista Pedidos</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open text-kmisetas-hover"></i></div>
                                Pages 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Gráficos
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tablas
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Creado Por:</div>
                        Willy
                    </div>
                </nav>
            </div>