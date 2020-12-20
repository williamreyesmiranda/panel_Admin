//icono reload
$(document).ready(function () {
    window.onload = function () {
        $('.centrado').fadeOut();
    }
});

//ocultar el sidebar
(function ($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

// Validar formularios
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
//agregar pedido
function agregarPedido() {
    $.ajax({
        type: "POST",
        url: "php/agregarPedido.php",
        data: $("#formIngresoPedido").serialize(),
        success: function (r) {
            if (r == 1) {
                alertify.success("Pedido Ingresado Correctamente");
            } else {
                alertify.error("Error al ingresar el pedido");
            }
        }
    });
}
//alerta al cancelar modal
$('.salirModal').click(function () {
    alertify.error("Se Canceló Proceso");
});


// SCRIPTS DATOS DE PEDIDOS
//ingresar datos a formulario editar pedido
function formEditarPedido(datos) {
    d = datos.split('||');
    $('.idPedidoEditar').val(d[0]);
    $('.nroPedidoEditar').val(d[1]);
    $('.clienteEdit').val(d[2]);
    $('.asesorEdit').val(d[3]);
    $('.inicioEditar').val(d[4]);
    $('.finEditar').val(d[5]);
    $('.undsEditar').val(d[7]);
    $('.procesosEditar').val(d[6]);
    $('.diasEditar').val(d[8]);
    $('.idProcesosEditar').val(d[9]);

}
//Editar Pedido
function editarPedido() {
    $.ajax({
        type: "POST",
        url: "php/editarPedido.php",
        data: $("#formEditarPedido").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('#mostrarTabla').load('tablas/tablaPedido.php');
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//Editar Proceso Pedido
function editarProceso() {
    $.ajax({
        type: "POST",
        url: "php/editarProceso.php",
        data: $("#formEditarProceso").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.centrado').fadeIn();
                $('#mostrarTabla').load('tablas/tablaPedido.php');
                $('.centrado').fadeOut();
                alertify.success("Proceso Editado Correctamente");
            } else {
                alertify.error('Error al editar Proceso');
            }
        }
    });
}
//confirmar anulado
function confirmarAnuladoPedido(datos) {
    d = datos.split('||');
    idPedido = "id=" + d[0];
    alertify.prompt('Anular Pedido', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br><b>Asesor: </b>' + d[3] + '<br><b>Unds: </b>' + d[7] + '<br><b>Procesos: </b>' + d[6] + '<br><br>Motivo por la cual se anula el Pedido:<br>', '',
        function (evt, value) {
            input = idPedido + "&obs=" + value;
            anularPedido(input)
        },
        function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Anular', cancel: 'Cancelar' });
}
//anular Pedido
function anularPedido(datos) {


    $.ajax({
        type: "POST",
        url: "php/anularPedido.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('#mostrarTabla').load('tablas/tablaPedido.php');
                $('.tablaterminacion').load('tablas/tablaTerminacion.php');
                alertify.success('Pedido Anulado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }

        }
    });
}


//SCRIPTS DE CLIENTES
//ingresar datos a formulario editar cliente
function formEditarCliente(datos) {
    d = datos.split('||');
    $('.idCliente').val(d[0]);
    $('.documento').val(d[1]);
    $('.nombre').val(d[2]);
    $('.direccion').val(d[3]);
    $('.asesor').val(d[4]);
    $('.celular').val(d[5]);
    $('.correo').val(d[6]);

}
//Editar Cliente
function editarCliente() {

    $.ajax({
        type: "POST",
        url: "php/editarCliente.php",
        data: $("#formEditarCliente").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.centrado').fadeIn();
                $('.mostrarTabla').load('tablas/tablaClientes.php');
                $('.centrado').fadeOut();
                alertify.success("Cliente Editado Correctamente");
            } else {
                alertify.error('Error al Editar Cliente');
            }
        }
    });
}

//SCRIPTS DE ASESORES
//ingresar datos a formulario editar cliente
function formEditarAsesor(datos) {
    d = datos.split('||');
    $('.idAsesor').val(d[0]);
    $('.nombre').val(d[1]);
    $('.usuario').val(d[2]);
    $('.correo').val(d[3]);
    $('.celular').val(d[4]);

}
//Editar Asesor
function editarAsesor() {

    $.ajax({
        type: "POST",
        url: "php/editarAsesor.php",
        data: $("#formEditarAsesor").serialize(),
        datatype: "json",
        success: function (r) {

            if (r == 1) {
                $('.mostrarTabla').load('tablas/tablaAsesores.php');
                alertify.success("Asesor Editado Correctamente");
            } else {
                alertify.error('Error al Editar Asesor');
            }
        }
    });
}


//SCRIPTS DE VER PEDIDO EN MODAL (este modal está en navBar.php)
function verPedido(datos) {
    d = datos.split('||');
    $('.nroPedido').val("Nro Pedido: " + d[1]);
    $('.cliente').val("Cliente: " + d[2]);
    $('.asesor').val("Asesor: " + d[3] + " (" + d[15] + ")");
    $('.inicio').val("Fecha Inicio: " + d[4]);
    $('.fin').val("Fecha Entrega: " + d[5]);
    $('.dias').val("Días Hábiles: " + d[6]);
    $('.procesos').val("Procesos: " + d[7]);
    $('.unds').val("Unds: " + d[8]);
    $('.estadoPedido').val("Estado: " + d[9]);


}

//FINALIZAR NOVEDADES EN GENERAL
function finalizarNovedad() {

    $.ajax({
        type: "POST",
        url: "php/finalizarNovedad.php",
        data: $(".formFinalizarNovedad").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablabodega').load('tablas/tablaBodega.php');
                $('.tablacorte').load('tablas/tablaCorte.php');
                $('.tablaconfeccion').load('tablas/tablaConfeccion.php');
                $('.tablasublimacion').load('tablas/tablaSublimacion.php');
                $('.tablaestampacion').load('tablas/tablaEstampacion.php');
                $('.tablabordado').load('tablas/tablaBordado.php');
                $('.tablaterminacion').load('tablas/tablaTerminacion.php');
                alertify.success("Se ha finalizado  novedad Correctamente.");
            } else {
                alertify.error("No se ha reportado ninguna novedad para este pedido.");
            }
        }
    });
}


//RESTAURAR PEDIDOS EN GENERAL
//prevenir que se envie datos con ENTER
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
        if (e.keyCode == 13) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "php/cargarPedidosFinalizados.php",
                data: $('#formRestaurarPedido').serialize(),
                success: function (r) {
                    $('#tablaRestaurar').html(r);
                    $('#nroPedido').focus();
                    $('#nroPedido').val('');
                }
            });
        }
    }))
});
//cargar datos con change
$('#nroPedido').change(function (e) {
    $.ajax({
        type: "POST",
        url: "php/cargarPedidosFinalizados.php",
        data: $('#formRestaurarPedido').serialize(),
        success: function (r) {
            $('#tablaRestaurar').html(r);
            $('#nroPedido').focus();
            $('#nroPedido').val('');
        }
    });

});
//restaurar pedidos
$('#btnRestaurar').click(function () {
    $.ajax({
        type: "POST",
        url: "php/restaurarPedidos.php",
        data: $('#formRestaurarPedido').serialize(),
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('.tablabodega').load('tablas/tablaBodega.php');
                $('.tablacorte').load('tablas/tablaCorte.php');
                $('.tablaconfeccion').load('tablas/tablaConfeccion.php');
                $('.tablasublimacion').load('tablas/tablaSublimacion.php');
                $('.tablaestampacion').load('tablas/tablaEstampacion.php');
                $('.tablabordado').load('tablas/tablaBordado.php');
                $('.tablaterminacion').load('tablas/tablaTerminacion.php');
                alertify.success('Pedido Restaurado');
            } else {
                alertify.error('Error al Restaurar Pedido');
            }
            $('#nroPedido').val('');
            $('#tablaRestaurar').html('');
        }
    });

});


//SCRIPTS DE BODEGA
//Ingresar datos aformulario editar bodega
function formEditarBodega(datos) {
    d = datos.split('||');
    $('.idPedido').val(d[0]);
    $('.nroPedido').val(d[1]);
    $('.cliente').val(d[2]);
    $('.asesor').val(d[3]);
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.asesor').html("<b>Asesor:</b> " + d[3] + " (" + d[15] + ")");
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.correoAsesor').html("<b>Correo Asesor:</b> " + d[16]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[7]);
    $('.unds').html("<b>Unds:</b> " + d[8]);
    $('.idBodega').val(d[10]);
    $('.obs_bodega').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idNovedad').val(d[13]);
    $('.novedad').val(d[14]);

}
//Editar Bodega
function editarBodega() {
    $.ajax({
        type: "POST",
        url: "php/editarBodega.php",
        data: $("#formEditarBodega").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.centrado').fadeIn();
                $('.tablabodega').load('tablas/tablaBodega.php');
                $('.centrado').fadeOut();
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//novedad Bodega
function novedadBodega() {

    $.ajax({
        type: "POST",
        url: "php/novedadBodega.php",
        data: $("#formNovedadBodega").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.centrado').fadeIn();
                $('.tablabodega').load('tablas/tablaBodega.php');
                $('.centrado').fadeOut();
                alertify.success("Novedad Generada Correctamente. Se ha enviado copia al Comercial");
            } else {
                alertify.error('Error al generar Novedad');
            }
        }
    });
} //confirmar finalizado
function confirmarFinalizarBodega(datos) {
    d = datos.split('||');
    idPedido = "idPedido=" + d[0];
    idBodega = "&idBodega=" + d[10];
    idNovedad = "&idNovedad=" + d[13];
    unds = "&unds=" + d[8];
    if (d[13] != 0) {
        alertify.alert('Finalizar Novedad', '<center>Este pedido contiene una novedad que no ha sido solucionada. <br>Por favor darle trámite para finalizar Pedido.</center>');
    } else {
        alertify.prompt('Finalizar Bodega', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br><b>Asesor: </b>' + d[3] + " (" + d[15] + ")" + '<br><b>Unds: </b>' + d[8] + '<br><b>Procesos: </b>' + d[7] + '<br><br>Observaciones de Finalizado :<br>', '',
            function (evt, obs) {
                input = idPedido + "&obs=" + obs + idBodega + unds + idNovedad;
                finalizarBodega(input)
            },
            function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Finalizar', cancel: 'Cancelar' });
    }
}
//finalizar Pedido
function finalizarBodega(datos) {
    $.ajax({
        type: "POST",
        url: "php/finalizarBodega.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('.tablabodega').load('tablas/tablaBodega.php');
                alertify.success('Pedido Finalizado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }

        }
    });
}


//SCRIPTS DE CORTE
//Ingresar datos aformulario editar CORTE
function formEditarCorte(datos) {
    d = datos.split('||');
    $('.idPedido').val(d[0]);
    $('.nroPedido').val(d[1]);
    $('.cliente').val(d[2]);
    $('.asesor').val(d[3]);
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.asesor').html("<b>Asesor:</b> " + d[3] + " (" + d[15] + ")");
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.correoAsesor').html("<b>Correo Asesor:</b> " + d[16]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[7]);
    $('.unds').html("<b>Unds:</b> " + d[8]);
    $('.idCorte').val(d[10]);
    $('.obs_corte').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idNovedad').val(d[13]);
    $('.novedad').val(d[14]);
    $('.oc').val(d[17]);

}
//Editar Corte
function editarCorte() {
    $.ajax({
        type: "POST",
        url: "php/editarCorte.php",
        data: $("#formEditarCorte").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.tablacorte').load('tablas/tablaCorte.php');
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//novedad Bodega
function novedadCorte() {

    $.ajax({
        type: "POST",
        url: "php/novedadCorte.php",
        data: $("#formNovedadCorte").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablacorte').load('tablas/tablaCorte.php');
                alertify.success("Novedad Generada Correctamente. Se ha enviado copia al Comercial");
            } else {
                alertify.error('Error al generar Novedad');
            }
        }
    });
} //confirmar finalizado
function confirmarFinalizarCorte(datos) {
    d = datos.split('||');
    idPedido = "idPedido=" + d[0];
    idCorte = "&idCorte=" + d[10];
    unds = "&unds=" + d[8];
    if (d[13] != 0) {
        alertify.alert('Finalizar Novedad', '<center>Este pedido contiene una novedad que no ha sido solucionada. <br>Por favor darle trámite para finalizar Pedido.</center>');
    } else {
        alertify.prompt('Finalizar Corte', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br><b>Asesor: </b>' + d[3] + " (" + d[15] + ")" + '<br><b>Unds: </b>' + d[8] + '<br><b>Procesos: </b>' + d[7] + '<br><br>Observaciones de Finalizado :<br>', '',
            function (evt, obs) {
                input = idPedido + idCorte + unds + "&obs=" + obs;
                finalizarCorte(input);
            },
            function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Finalizar', cancel: 'Cancelar' });
    }
}
//finalizar Pedido
function finalizarCorte(datos) {
    $.ajax({
        type: "POST",
        url: "php/finalizarCorte.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('.tablacorte').load('tablas/tablaCorte.php');
                alertify.success('Pedido Finalizado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }

        }
    });
}


//SCRIPTS DE CONFECCION
//Ingresar datos aformulario editar CORTE
function formEditarConfeccion(datos) {
    d = datos.split('||');
    $('.idPedido').val(d[0]);
    $('.nroPedido').val(d[1]);
    $('.cliente').val(d[2]);
    $('.asesor').val(d[3]);
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.asesor').html("<b>Asesor:</b> " + d[3] + " (" + d[15] + ")");
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.correoAsesor').html("<b>Correo Asesor:</b> " + d[16]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[7]);
    $('.unds').html("<b>Unds:</b> " + d[8]);
    $('.idConfeccion').val(d[10]);
    $('.obs_confeccion').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idNovedad').val(d[13]);
    $('.novedad').val(d[14]);
    $('.entrega').val(d[17]);

}
//Editar confeccion
function editarConfeccion() {
    $.ajax({
        type: "POST",
        url: "php/editarConfeccion.php",
        data: $("#formEditarConfeccion").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablaconfeccion').load('tablas/tablaConfeccion.php');
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//novedad Bodega
function novedadConfeccion() {

    $.ajax({
        type: "POST",
        url: "php/novedadConfeccion.php",
        data: $("#formNovedadConfeccion").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablaconfeccion').load('tablas/tablaConfeccion.php');
                alertify.success("Novedad Generada Correctamente. Se ha enviado copia al Comercial");
            } else {
                alertify.error('Error al generar Novedad');
            }
        }
    });
}
//confirmar finalizado
function confirmarFinalizarConfeccion(datos) {
    d = datos.split('||');
    idPedido = "idPedido=" + d[0];
    idConfeccion = "&idConfeccion=" + d[10];
    unds = "&unds=" + d[8];
    if (d[13] != 0) {
        alertify.alert('Finalizar Novedad', '<center>Este pedido contiene una novedad que no ha sido solucionada. <br>Por favor darle trámite para finalizar Pedido.</center>');
    } else {
        alertify.prompt('Finalizar Confeccion', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br><b>Asesor: </b>' + d[3] + " (" + d[15] + ")" + '<br><b>Unds: </b>' + d[8] + '<br><b>Procesos: </b>' + d[7] + '<br><br>Observaciones de Finalizado :<br>', '',
            function (evt, obs) {
                input = idPedido + idConfeccion + unds + "&obs=" + obs;
                finalizarConfeccion(input);
            },
            function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Finalizar', cancel: 'Cancelar' });
    }
}
//finalizar Pedido
function finalizarConfeccion(datos) {
    $.ajax({
        type: "POST",
        url: "php/finalizarConfeccion.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('.tablaconfeccion').load('tablas/tablaConfeccion.php');
                alertify.success('Pedido Finalizado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }

        }
    });
}


//SCRIPTS DE SUBLIMACION
//Ingresar datos aformulario editar Sublimacion
function formEditarSublimacion(datos) {
    d = datos.split('||');
    $('.idPedido').val(d[0]);
    $('.nroPedido').val(d[1]);
    $('.cliente').val(d[2]);
    $('.asesor').val(d[3]);
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.asesor').html("<b>Asesor:</b> " + d[3] + " (" + d[15] + ")");
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.correoAsesor').html("<b>Correo Asesor:</b> " + d[16]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[7]);
    $('.unds').html("<b>Unds:</b> " + d[8]);
    $('.idSublimacion').val(d[10]);
    $('.obs_sublimacion').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idNovedad').val(d[13]);
    $('.novedad').val(d[14]);


}
//Editar Sublimacion
function editarSublimacion() {
    $.ajax({
        type: "POST",
        url: "php/editarSublimacion.php",
        data: $("#formEditarSublimacion").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.tablasublimacion').load('tablas/tablaSublimacion.php');
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//novedad Sublimacion
function novedadSublimacion() {

    $.ajax({
        type: "POST",
        url: "php/novedadSublimacion.php",
        data: $("#formNovedadSublimacion").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablasublimacion').load('tablas/tablaSublimacion.php');
                alertify.success("Novedad Generada Correctamente. Se ha enviado copia al Comercial");
            } else {
                alertify.error('Error al generar Novedad');
            }
        }
    });
} //confirmar finalizado
function confirmarFinalizarSublimacion(datos) {
    d = datos.split('||');
    idPedido = "idPedido=" + d[0];
    idSublimacion = "&idSublimacion=" + d[10];
    unds = "&unds=" + d[8];
    if (d[13] != 0) {
        alertify.alert('Finalizar Novedad', '<center>Este pedido contiene una novedad que no ha sido solucionada. <br>Por favor darle trámite para finalizar Pedido.</center>');
    } else {
        alertify.prompt('Finalizar Sublimación', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br><b>Asesor: </b>' + d[3] + " (" + d[15] + ")" + '<br><b>Unds: </b>' + d[8] + '<br><b>Procesos: </b>' + d[7] + '<br><br>Observaciones de Finalizado :<br>', '',
            function (evt, obs) {
                input = idPedido + idSublimacion + unds + "&obs=" + obs;
                finalizarSublimacion(input);
            },
            function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Finalizar', cancel: 'Cancelar' });
    }
}
//finalizar Pedido
function finalizarSublimacion(datos) {
    $.ajax({
        type: "POST",
        url: "php/finalizarSublimacion.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('.tablasublimacion').load('tablas/tablaSublimacion.php');
                alertify.success('Pedido Finalizado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }

        }
    });
}


//SCRIPTS DE ESTAMPACION
//Ingresar datos aformulario editar Estampacion
function formEditarEstampacion(datos) {
    d = datos.split('||');
    $('.idPedido').val(d[0]);
    $('.nroPedido').val(d[1]);
    $('.cliente').val(d[2]);
    $('.asesor').val(d[3]);
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.asesor').html("<b>Asesor:</b> " + d[3] + " (" + d[15] + ")");
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.correoAsesor').html("<b>Correo Asesor:</b> " + d[16]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[7]);
    $('.unds').html("<b>Unds:</b> " + d[8]);
    $('.idEstampacion').val(d[10]);
    $('.obs_estampacion').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idNovedad').val(d[13]);
    $('.novedad').val(d[14]);
    $('.arte_diseno').val(d[17]);
    $('.arte_impresion').val(d[32]);
    if (d[18] == 'si') { $('.grabacion').val('✓'); } else { $('.grabacion').val(d[18]); }
    $('.estampacion').val(d[19]);
    $('.sublimacion').val(d[20]);
    $('.tecnica').val(d[21]);
    $('.nro_diseno').val(d[22]);
    $('.posicion').val(d[23]);
    $('.seda').val(d[24]);
    $('.nro_plancha').val(d[25]);
    $('.fren').val(d[26]);
    $('.esp').val(d[27]);
    $('.otro').val(d[28]);
    $('.prep').val(d[29]);
    $('.est').val(d[30]);
    $('.sub').val(d[31]);

}
//Editar estampacion
function editarEstampacion() {
    $.ajax({
        type: "POST",
        url: "php/editarEstampacion.php",
        data: $("#formEditarEstampacion").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.tablaestampacion').load('tablas/tablaEstampacion.php');
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//novedad Estampacion
function novedadEstampacion() {

    $.ajax({
        type: "POST",
        url: "php/novedadEstampacion.php",
        data: $("#formNovedadEstampacion").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablaestampacion').load('tablas/tablaEstampacion.php');
                alertify.success("Novedad Generada Correctamente. Se ha enviado copia al Comercial");
            } else {
                alertify.error('Error al generar Novedad');
            }
        }
    });
} //confirmar finalizado
function confirmarFinalizarEstampacion(datos) {
    d = datos.split('||');
    idPedido = "idPedido=" + d[0];
    idEstampacion = "&idEstampacion=" + d[10];
    unds = "&unds=" + d[8];
    if (d[13] != 0) {
        alertify.alert('Finalizar Novedad', '<center>Este pedido contiene una novedad que no ha sido solucionada. <br>Por favor darle trámite para finalizar Pedido.</center>');
    } else {
        alertify.prompt('Finalizar Sublimación', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br><b>Asesor: </b>' + d[3] + " (" + d[15] + ")" + '<br><b>Unds: </b>' + d[8] + '<br><b>Procesos: </b>' + d[7] + '<br><br>Observaciones de Finalizado :<br>', '',
            function (evt, obs) {
                input = idPedido + idEstampacion + unds + "&obs=" + obs;
                finalizarEstampacion(input);
            },
            function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Finalizar', cancel: 'Cancelar' });
    }
}
//finalizar Pedido
function finalizarEstampacion(datos) {
    $.ajax({
        type: "POST",
        url: "php/finalizarEstampacion.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('.tablaestampacion').load('tablas/tablaEstampacion.php');
                alertify.success('Pedido Finalizado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }

        }
    });
}


//SCRIPTS DE BORDADO
//Ingresar datos aformulario editar Bordado
function formEditarBordado(datos) {
    d = datos.split('||');
    $('.idPedido').val(d[0]);
    $('.nroPedido').val(d[1]);
    $('.cliente').val(d[2]);
    $('.asesor').val(d[3]);
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.asesor').html("<b>Asesor:</b> " + d[3] + " (" + d[15] + ")");
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.correoAsesor').html("<b>Correo Asesor:</b> " + d[16]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[7]);
    $('.unds').html("<b>Unds:</b> " + d[8]);
    $('.idBordado').val(d[10]);
    $('.obs_bordado').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idNovedad').val(d[13]);
    $('.novedad').val(d[14]);
    $('.logo').val(d[17]);
    if (d[18] == "x") { $('.pte_diseno').val('X') } else { $('.pte_diseno').val(d[18]) };
    $('.num_bordado').val(d[19]);
    if (d[20] == "x") { $('.muestra').val("X") } else { $('.muestra').val(d[20]) };
    $('.punt_unidad').val(d[21]);


}
//Editar Bordado
function editarBordado() {
    $.ajax({
        type: "POST",
        url: "php/editarBordado.php",
        data: $("#formEditarBordado").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.tablabordado').load('tablas/tablaBordado.php');
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//novedad Bordado
function novedadBordado() {

    $.ajax({
        type: "POST",
        url: "php/novedadBordado.php",
        data: $("#formNovedadBordado").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablabordado').load('tablas/tablaBordado.php');
                alertify.success("Novedad Generada Correctamente. Se ha enviado copia al Comercial");
            } else {
                alertify.error('Error al generar Novedad');
            }
        }
    });
} //confirmar finalizado
function confirmarFinalizarBordado(datos) {
    d = datos.split('||');
    idPedido = "idPedido=" + d[0];
    idBordado = "&idBordado=" + d[10];
    unds = "&unds=" + d[8];
    if (d[13] != 0) {
        alertify.alert('Finalizar Novedad', '<center>Este pedido contiene una novedad que no ha sido solucionada. <br>Por favor darle trámite para finalizar Pedido.</center>');
    } else {
        alertify.prompt('Finalizar Bordado', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br><b>Asesor: </b>' + d[3] + " (" + d[15] + ")" + '<br><b>Unds: </b>' + d[8] + '<br><b>Procesos: </b>' + d[7] + '<br><br>Observaciones de Finalizado :<br>', '',
            function (evt, obs) {
                input = idPedido + idBordado + unds + "&obs=" + obs;
                finalizarBordado(input);
            },
            function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Finalizar', cancel: 'Cancelar' });
    }
}
//finalizar Pedido
function finalizarBordado(datos) {
    $.ajax({
        type: "POST",
        url: "php/finalizarBordado.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            if (data == 1) {
                $('.tablabordado').load('tablas/tablaBordado.php');
                alertify.success('Pedido Finalizado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }

        }
    });
}


//SCRIPTS DE TERMINACION
//Ingresar datos aformulario editar Terminacion
function formEditarTerminacion(datos) {
    d = datos.split('||');
    $('.idPedido').val(d[0]);
    $('.nroPedido').val(d[1]);
    $('.cliente').val(d[2]);
    $('.asesor').val(d[3]);
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.correoCliente').html("<b>Correo Cliente:</b> " + d[17]);
    $('.asesor').html("<b>Asesor:</b> " + d[3] + " (" + d[15] + ")");
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.correoAsesor').html("<b>Correo Asesor:</b> " + d[16]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[6]);
    $('.unds').html("<b>Unds:</b> " + d[7]);
    $('.idTerminacion').val(d[10]);
    $('.obs_terminacion').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idNovedad').val(d[13]);
    $('.novedad').val(d[14]);
    $('.correoCliente').val(d[17]);
}
//Editar Terminacion
function editarTerminacion() {
    $.ajax({
        type: "POST",
        url: "php/editarTerminacion.php",
        data: $("#formEditarTerminacion").serialize(),
        datatype: "json",
        success: function (r) {
            console.log(r);
            if (r == 1) {
                $('.tablaterminacion').load('tablas/tablaTerminacion.php');
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//novedad Terminacion
function novedadTerminacion() {

    $.ajax({
        type: "POST",
        url: "php/novedadTerminacion.php",
        data: $("#formNovedadTerminacion").serialize(),
        datatype: "json",
        success: function (r) {
            if (r == 1) {
                $('.tablaterminacion').load('tablas/tablaTerminacion.php');
                alertify.success("Novedad Generada Correctamente. Se ha enviado copia al Comercial");
            } else {
                alertify.error('Error al generar Novedad');
            }
        }
    });
} //confirmar finalizado
function confirmarFinalizarTerminacion(datos) {
    d = datos.split('||');
    idPedido = "idPedido=" + d[0];
    idTerminacion = "&idTerminacion=" + d[10];
    unds = "&unds=" + d[8];
    correoAsesor = "&correoAsesor=" + d[16];
    correoCliente = "&correoCliente=" + d[17];
    nombreCliente = "&nombreCliente=" + d[2];
    nombreAsesor = "&nombreAsesor=" + d[15];
    nroPedido = "&nroPedido=" + d[1];

    if (d[17] != '') {
        if (d[13] != 0) {
            alertify.alert('Finalizar Novedad', '<center>Este pedido contiene una novedad que no ha sido solucionada. <br>Por favor darle trámite para finalizar Pedido.</center>');
        } else {
            alertify.prompt('Finalizar Terminacion', '<b>Pedido: </b>' + d[1] + '<br><b>Cliente: </b>' + d[2] + '<br> <b> Correo Cliente: </b>' + d[17] + ' <br> <b> Asesor: </b> ' + d[3] + " (" + d[15] + ")" + ' <br> <b> Unds: </b> ' + d[7] + ' <br> <b> Procesos: </b> ' + d[6] + ' <br> <br> Observaciones de Finalizado: <br> ', '',
                function (evt, obs) {
                    input = idPedido + idTerminacion + unds + "&obs=" + obs + correoAsesor + correoCliente + nombreCliente + nombreAsesor + nroPedido;
                    finalizarTerminacion(input);
                },
                function () { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Finalizar', cancel: 'Cancelar' });
        }
    } else {
        alertify.alert('Ingresar Correo al Cliente', '<center>El Cliente no tiene correo, por favor hablar con el comercial para actualizar datos del clientes.</center>');
    }

}
//finalizar Pedido
function finalizarTerminacion(datos) {
    console.log(datos)
    $.ajax({
        type: "POST",
        url: "php/finalizarTerminacion.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            console.log(data);
            if (data == 1) {
                $('.tablaterminacion').load('tablas/tablaTerminacion.php');
                alertify.success('Pedido Finalizado Correctamente');
            } else {
                alertify.error('Error al Anular Pedido');
            }
        }
    });
    //enviar correo al cliente
    $.ajax({
        type: "POST",
        url: "php/correoCliente.php",
        data: datos,
        dataType: "json",
        success: function (data) {
            console.log(data);
            if (data == 1) {
                alertify.success('Se ha enviado correo al Cliente y al Comercial');
            } else if (data == 2) {
                alertify.warning('El correo no se envía hasta que todo quede terminado');
            } else {
                alertify.error('Error al procesar datos');
            }
        }
    });
}

