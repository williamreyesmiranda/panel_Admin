//icono reload
$(document).ready(function() {
    $('.centrado').fadeIn();
    window.onload = function() {
        $('.centrado').fadeOut();
    }
});

//ocultar el sidebar
(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

// Validar formularios
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
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
        success: function(r) {
            if (r == 1) {
                alertify.success("Pedido Ingresado Correctamente");
            } else {
                alertify.error("Error al ingresar el pedido");
            }
        }
    });
}
//alerta al cancelar modal
$('.salirModal').click(function() {
    alertify.error("Se Canceló Proceso");
});

// SCRIPT DATOS DE PEDIDOS

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
        success: function(r) {
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
        success: function(r) {
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
        function(evt, value) {
            input = idPedido + "&obs=" + value;
            anularPedido(input)
        },
        function() { alertify.error('Se Canceló Proceso') }).set('labels', { ok: 'Anular', cancel: 'Cancelar' });
}
//anular Pedido
function anularPedido(datos) {


    $.ajax({
        type: "POST",
        url: "php/anularPedido.php",
        data: datos,
        dataType: "json",
        success: function(data) {
            if (data == 1) {
                $('#mostrarTabla').load('tablas/tablaPedido.php');
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
        success: function(r) {
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
        success: function(r) {
            console.log(r);
            if (r == 1) {
                $('.centrado').fadeIn();
                $('.mostrarTabla').load('tablas/tablaAsesores.php');
                $('.centrado').fadeOut();
                alertify.success("Asesor Editado Correctamente");
            } else {
                alertify.error('Error al Editar Asesor');
            }
        }
    });
}


//SCRIPT DE VER PEDIDO EN MODAL
function verPedido(datos) {
    d = datos.split('||');
    $('.nroPedido').val("Nro Pedido: " + d[1]);
    $('.cliente').val("Cliente: " + d[2]);
    $('.asesor').val("Asesor: " + d[3]);
    $('.inicio').val("Fecha Inicio: " + d[4]);
    $('.fin').val("Fecha Entrega: " + d[5]);
    $('.dias').val("Días Hábiles: " + d[6]);
    $('.procesos').val("Procesos: " + d[7]);
    $('.unds').val("Unds: " + d[8]);
    $('.estadoPedido').val("Estado: " + d[9]);


}

//SCRIPT DE BODEGA
//Ingresar datos aformulario editar bodega
function formEditarBodega(datos) {
    d = datos.split('||');
    $('.nroPedido').html("<b>Nro Pedido:</b> " + d[1]);
    $('.cliente').html("<b>Cliente:</b> " + d[2]);
    $('.asesor').html("<b>Asesor:</b> " + d[3]);
    $('.inicio').html("<b>Fecha Inicio:</b> " + d[4]);
    $('.fin').html("<b>Fecha Entrega:</b> " + d[5]);
    $('.procesos').html("<b>Procesos:</b> " + d[7]);
    $('.unds').html("<b>Unds:</b> " + d[8]);
    $('.idBodega').val(d[10]);
    $('.obs_bodega').val(d[11]);
    $('.parcial').val(d[12]);
    $('.idPedido').val(d[0]);
}
//Editar Bodega
function editarBodega() {
    alert($("#formEditarBodega").serialize(), );
    $.ajax({
        type: "POST",
        url: "php/editarBodega.php",
        data: $("#formEditarBodega").serialize(),
        datatype: "json",
        success: function(r) {
            console.log(r);
            if (r == 1) {
                $('.centrado').fadeIn();
                $('.mostrarTabla').load('tablas/tablaBodega.php');
                $('.centrado').fadeOut();
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}