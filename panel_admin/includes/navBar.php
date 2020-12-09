<nav class="sb-topnav navbar navbar-expand navbar-dark sb-sidenav-dark ">
    <a class="navbar-brand" href="index.php"><img src="images/logo_kamisetas.png" style="width:100px; height:50px" alt=""></a>
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
                            Confección
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
                <!-- Sublimacion -->
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseSublimacion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Sublimación
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseSublimacion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listaSublimacion.php">Lista Pedidos</a>
                                <a class="nav-link" href="reporteSublimacion.php">Reporte</a>
                            </nav>
                        </div>

                    </nav>
                </div>
                <!-- estampacion -->
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseEstampacion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Estampación
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseEstampacion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listaEstampacion.php">Lista Pedidos</a>
                                <a class="nav-link" href="reporteEstampacion.php">Reporte</a>
                            </nav>
                        </div>

                    </nav>
                </div>
                <!-- Bordado -->
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseBordado" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Bordado
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseBordado" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listaBordado.php">Lista Pedidos</a>
                                <a class="nav-link" href="reporteBordado.php">Reporte</a>
                            </nav>
                        </div>

                    </nav>
                </div>
                <!-- Terminación -->
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseTerminacion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Terminación
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseTerminacion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listaTerminacion.php">Lista Pedidos</a>
                                <a class="nav-link" href="reporteTerminacion.php">Reporte</a>
                            </nav>
                        </div>

                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Cartera</div>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Nomina
                </a>
                <a class="nav-link" href="#">
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

    <!-- modal ver pedido  -->
    <div class="modal fade" id="verPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h2 class="modal-title text-center">Información Detallada del Pedido</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" mx-auto d-block border border-dark rounded col-md-9">
                        <h3 class="mx-auto d-block mt-2 p-1 text-center"><span></span></h3>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm nroPedido" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control cliente" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control asesor" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm inicio" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm fin" disabled>
                        </div>
                        <div class="form-group">
                            <input class="form-control input-sm dias" type="text " disabled>
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control input-sm unds" disabled>
                        </div>

                        <div class="form-group ">
                            <input type="text" class="form-control input-sm procesos" disabled>
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control input-sm estadoPedido" disabled>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-dark " data-dismiss="modal" id="">Aceptar</button>

                </div>
            </div>
        </div>



    </div>