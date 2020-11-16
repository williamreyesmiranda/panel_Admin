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

function btnCancelar() {
    alertify.error('Proceso Cancelado');
}

function formEditarPedido(datos) {
    d = datos.split('||');
    $('#idPedidoEditar').val(d[0]);
    $('#nroPedidoEditar').val(d[1]);
    $('#clienteEdit').val(d[2]);
    $('#asesorEdit').val(d[3]);
    $('#inicioEditar').val(d[4]);
    $('#finEditar').val(d[5]);
    $('#undsEditar').val(d[7]);
    $('#procesosEditar').val(d[6]);
    $('#diasEditar').html(d[8]);
    $('#idProcesosEditar').val(d[9]);
}

//Editar Pedido
function editarPedido() {

    $.ajax({
        type: "POST",
        url: "php/editarPedido.php",
        data: $("#formEditarPedido").serialize(),
        success: function(r) {
            if (r == 1) {
                alertify.success("Pedido Editado Correctamente");
            } else {
                alertify.error('Error al Editar Pedido');
            }
        }
    });
}
//confirmar anulado

function confirmarAnuladoPedido() {
    alertify.prompt('Anular Pedido', 'Prompt Message', 'Prompt Value',
        function(evt, value) { alertify.success('You entered: ' + value) },
        function() { alertify.error('Cancel') });
}