

<nav class="sb-topnav navbar navbar-expand navbar-dark sb-sidenav-dark ">
    <a class="navbar-brand" href="index.php"><img src="images/logo_kamisetas.png" style="width:100px; height:50px"alt=""></a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav  ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <p class="text-kmisetas mx-auto"><?php
                                            include("functions.php");
                                            /* echo fechaC(); */ ?> </p>&nbsp;&nbsp;

        <h5 class="text-kmisetas mx-auto"><?php
                                            date_default_timezone_set('America/Bogota');
                                            echo "  |  " . ($_SESSION['nombre']) . "  (  " . ($_SESSION['rol']) . "  )" ?></h5>
        <li class="nav-item dropdown ml-3">
            <a class="text-kmisetas-hover dropdown-toggle" href="#" data-toggle="dropdown" data-target="#salir" aria-expanded="false" aria-controls="collapseLayouts">
                <i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" id="salir">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="dropdown-item" href="#">Configuración</a>
                    <a class="dropdown-item" href="#">Actividades</a>
                    <hr>
                    <a class="dropdown-item" href="../db/logout.php">Salir</a>
                </nav>
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
                    <!-- <a class="nav-link text-kmisetas-hover" href="index.php">
                        <div class="sb-nav-link-icon text-kmisetas-hover"><i class="fas fa-home"></i></div>
                        Inicio
                    </a> -->
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#administracion" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon text-kmisetas-hover"><i class="fas fa-asterisk"></i></div>
                        Maestro
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                    </a>
                    <div class="collapse" id="administracion" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-kmisetas-hover" href="listaClientes.php">Clientes</a>
                            <a class="nav-link text-kmisetas-hover" href="listaAsesores.php">Asesores</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <?php if ($_SESSION['idrol'] == 3 || $_SESSION['idrol'] == 4 || $_SESSION['idrol'] == 1) : ?>
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
                <?php endif; ?>
                <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open text-kmisetas-hover"></i></div>
                    Áreas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                </a>
                <!-- bodega -->
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseBodega" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Bodega
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseBodega" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listaBodega.php">Lista Pedidos</a>
                                <a class="nav-link" href="reporteBodega.php">Reporte</a>
                            </nav>
                        </div>
                        
                    </nav>
                </div>
                <!-- corte -->
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseCorte" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Corte
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseCorte" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listaCorte.php">Lista Pedidos</a>
                                <a class="nav-link" href="reporteCorte.php">Reporte</a>
                            </nav>
                        </div>
                        
                    </nav>
                </div>
                <!-- confeccion -->
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseConfeccion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Confeccion
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseConfeccion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listaConfeccion.php">Lista Pedidos</a>
                                <a class="nav-link" href="reporteConfeccion.php">Reporte</a>
                            </nav>
                        </div>
                        
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Cartera</div>
                <a class="nav-link" href="ensayo.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Nomina
                </a>
                <a class="nav-link" href="kmk">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Liquidaciones
                </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Creado Por:</div>
                Willy
            </div>
        </nav>
    </div>
   