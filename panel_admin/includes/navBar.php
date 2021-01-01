<nav class="sb-topnav navbar navbar-dark navbar-expand " style="background: #00a8a8; z-index:200 !important;">
    <a class="navbar-brand" href="index.php"></a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 " id="sidebarToggle" href="#"><i class="fas fa-bars text-dark"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav  ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <p class=" mx-auto"><?php

                            include("functions.php");
                            /* echo fechaC(); */ ?> </p>&nbsp;&nbsp;

        <h5 class=" mx-auto"><?php
                                date_default_timezone_set('America/Bogota');
                                echo "  |  " . ($_SESSION['nombre']) . "  (  " . ($_SESSION['rol']) . "  )" ?></h5>
        <li class="nav-item dropdown ml-3 ">
            <a class=" dropdown-toggle text-dark" href="#" data-toggle="dropdown" data-target="#salir" aria-expanded="false" aria-controls="collapseLayouts">
                <i class="fas fa-user fa-fw "></i></a>
            <div class="dropdown-menu dropdown-menu-right " id="salir">
                <nav class="sb-sidenav-menu-nested nav ">
                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#editarUsuario">Editar Usuario</a>
                    <hr>
                    <a class="dropdown-item" href="../db/logout.php">Salir</a>
                </nav>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style=" z-index: 200 !important; background:#000000;">
            <a class="navbar-brand" href="index.php"><img src="images/logo_kamisetas.png" style="width:100px; height:50px; position:fixed; top:20px; margin:0% 20%" alt=""></a>
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#administracion" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon text-kmisetas-hover"><i class="fab fa-dashcube"></i></div>
                        Maestro
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                    </a>
                    <div class="collapse" id="administracion" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-kmisetas-hover" href="listaClientes.php">Clientes</a>
                            <a class="nav-link text-kmisetas-hover" href="listaAsesores.php">Asesores</a>
                            <a class="nav-link text-kmisetas-hover" href="listaTallas.php">Tallas</a>
                            <a class="nav-link text-kmisetas-hover" href="listaColores.php">Colores</a>
                            <a class="nav-link text-kmisetas-hover" href="listaReferencias.php">Referencias</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#collapseStock" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon text-kmisetas-hover"><i class="fas fa-tshirt"></i></div>
                        Stock Mínimo
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                    </a>
                    <div class="collapse" id="collapseStock" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-kmisetas-hover" href="stockMinimo.php">Lista</a>
                            <a class="nav-link text-kmisetas-hover" href="#">Reporte</a>
                        </nav>
                    </div>
                    <?php if ($_SESSION['idrol'] == 3 || $_SESSION['idrol'] == 4 || $_SESSION['idrol'] == 1) : ?>
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
                    <?php endif; ?>
                    <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open text-kmisetas-hover"></i></div>
                        Áreas
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                    </a>
                    <!-- bodega -->
                    <?php if ($_SESSION['idrol'] == 4 || $_SESSION['idrol'] == 1) : ?>
                        <div class="collapse" id="collapsePages" aria-labelledby="heading1" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#pagesCollapseBodega" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Bodega
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseBodega" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link text-kmisetas-hover" href="listaBodega.php">Lista Pedidos</a>
                                        <a class="nav-link text-kmisetas-hover" href="reporteBodega.php">Reporte</a>
                                    </nav>
                                </div>

                            </nav>
                        </div>
                    <?php endif; ?>
                    <!-- corte -->
                    <?php if ($_SESSION['idrol'] == 3 || $_SESSION['idrol'] == 1) : ?>
                        <div class="collapse" id="collapsePages" aria-labelledby="heading2" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#pagesCollapseCorte" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Corte
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseCorte" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link text-kmisetas-hover" href="listaCorte.php">Lista Pedidos</a>
                                        <a class="nav-link text-kmisetas-hover" href="reporteCorte.php">Reporte</a>
                                    </nav>
                                </div>

                            </nav>
                        </div>
                    <?php endif; ?>
                    <!-- confeccion -->
                    <?php if ($_SESSION['idrol'] == 2 || $_SESSION['idrol'] == 1) : ?>
                        <div class="collapse" id="collapsePages" aria-labelledby="heading3" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#pagesCollapseConfeccion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Confección
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseConfeccion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link text-kmisetas-hover" href="listaConfeccion.php">Lista Pedidos</a>
                                        <a class="nav-link text-kmisetas-hover" href="reporteConfeccion.php">Reporte</a>
                                    </nav>
                                </div>

                            </nav>
                        </div>
                    <?php endif; ?>
                    <!-- Sublimacion -->
                    <?php if ($_SESSION['idrol'] == 5 || $_SESSION['idrol'] == 1) : ?>
                        <div class="collapse" id="collapsePages" aria-labelledby="heading4" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#pagesCollapseSublimacion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Sublimación
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseSublimacion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link text-kmisetas-hover" href="listaSublimacion.php">Lista Pedidos</a>
                                        <a class="nav-link text-kmisetas-hover" href="reporteSublimacion.php">Reporte</a>
                                    </nav>
                                </div>

                            </nav>
                        </div>
                        <!-- estampacion -->
                        <div class="collapse" id="collapsePages" aria-labelledby="heading5" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#pagesCollapseEstampacion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Estampación
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseEstampacion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link text-kmisetas-hover" href="listaEstampacion.php">Lista Pedidos</a>
                                        <a class="nav-link text-kmisetas-hover" href="reporteEstampacion.php">Reporte</a>
                                    </nav>
                                </div>

                            </nav>
                        </div>
                    <?php endif; ?>
                    <!-- Bordado -->
                    <?php if ($_SESSION['idrol'] == 6 || $_SESSION['idrol'] == 1) : ?>
                        <div class="collapse" id="collapsePages" aria-labelledby="heading6" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#pagesCollapseBordado" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Bordado
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseBordado" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link text-kmisetas-hover" href="listaBordado.php">Lista Pedidos</a>
                                        <a class="nav-link text-kmisetas-hover" href="reporteBordado.php">Reporte</a>
                                    </nav>
                                </div>

                            </nav>
                        </div>
                    <?php endif; ?>
                    <!-- Terminación -->
                    <div class="collapse" id="collapsePages" aria-labelledby="heading7" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed text-kmisetas-hover" href="#" data-toggle="collapse" data-target="#pagesCollapseTerminacion" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Terminación
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-kmisetas-hover"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseTerminacion" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-kmisetas-hover" href="listaTerminacion.php">Lista Pedidos</a>
                                    <a class="nav-link text-kmisetas-hover" href="reporteTerminacion.php">Reporte</a>
                                </nav>
                            </div>

                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Gestion Humana</div>
                    <a class="nav-link" href="calendario.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Permisos
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Liquidaciones
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Creado Por:</div>
                WRMSoftware
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
    <!-- modal Restaurar Pedido -->
    <div class="modal fade" id="restaurarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h2 class="modal-title mx-auto">Restaurar Pedido</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="salirModal" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" mx-auto d-block border border-dark rounded col-md-9">
                        <h3 class="mx-auto d-block mt-2 p-1 text-center"><span>Escribe El número de Pedido</span></h3>

                        <form id="formRestaurarPedido" class="formRestaurarPedido" method="POST" novalidate>
                            <div class="form-group text-center col-md-5 mx-auto">
                                <input type="hidden" name="area" value="<?php echo ($area) ?>">
                                <input type="text" name="nroPedido" id="nroPedido" class="form-control " aria-describedby="helpId">
                            </div>
                            <div id="tablaRestaurar"></div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="btnRestaurar" onclick="">Restaurar Pedido</button>
                    <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- modal Editar Usuario -->
    <div class="modal fade" id="editarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h2 class="modal-title mx-auto">Editar Usuario</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="salirModal" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" mx-auto d-block border border-dark rounded col-md-9">

                        <form action="" id="formEditarUsuario" method="POST" class="mt-3" novalidate>
                            <div class="form-group">
                                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['iduser'] ?>">
                                <label for="nombre" class="font-weight-bold">Nombre:</label>
                                <input type="text" class="form-control " name="nombre" id="nombre" aria-describedby="helpId" value="<?php echo $_SESSION['nombre'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="cedula" class="font-weight-bold">Identificación:</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" aria-describedby="helpId" value="<?php echo $_SESSION['cedula'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="sexo" class="font-weight-bold">Género:</label>
                                <select name="sexo" id="sexo" class="custom-select itemunico">
                                    <option value="<?php echo $_SESSION['sexo'] ?>"><?php if ($_SESSION['sexo'] == 'hombre') {
                                                                                        echo "Masculino";
                                                                                    } else {
                                                                                        echo "Femenino";
                                                                                    } ?></option>
                                    <option value="hombre">Masculino</option>
                                    <option value="mujer">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usuario" class="font-weight-bold">Usuario:</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" value="<?php echo $_SESSION['user'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="clave" class="font-weight-bold">Contraseña:</label>
                                <input type="password" class="form-control" name="clave" id="clave" aria-describedby="helpId" value="<?php echo $_SESSION['clave'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="correo" class="font-weight-bold">Correo:</label>
                                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" value="<?php echo $_SESSION['correo'] ?>">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="btnEditarUsuario" onclick="editarUsuario()">Editar Usuario</button>
                    <button type="button" class="btn btn-danger salirModal" data-dismiss="modal" id="salirModal">Cancelar</button>

                </div>
            </div>
        </div>
    </div>