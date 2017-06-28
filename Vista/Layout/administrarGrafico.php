<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>Productos mas vendidos</strong></h4>
</div>


<script>
    $(function () {
        //cargarCompras();
    });
    var tabla = null;

    function cargarCompras() {
        $("#comprasRecientes").empty();
        var url_json = '../Servlet/administrarCompra.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var contenido = "<tr>";
                        contenido += "<td>" + v.idCompra + "</td>";
                        contenido += "<td>" + v.fechaCompra + "</td>";
                        contenido += "<td>" + v.estado + "</td>";
                        contenido += "<td>";
                        if (v.estado == "Procesando") {
                            contenido += "<a class='btn btn-danger btn-xs glyphicon glyphicon-trash'  onclick='borrar(" + v.idCompra + ")'><strong>Anular Compra</strong></a>&nbsp;";
                        } else {
                            contenido += "<a class='btn btn-info btn-xs glyphicon glyphicon-edit'  onclick='editar(" + v.idCompra + ")'><strong>Cambiar Estado</strong></a>&nbsp;";
                        }
                        contenido += "<a class='btn btn-warning btn-xs glyphicon glyphicon-search'  onclick='ver(" + v.idCompra + ")'><strong>Ver detalles</strong></a>";

                        contenido += "</td>";
                        contenido += "</tr>";
                        $("#comprasRecientes").append(contenido);
                    });
                    if (tabla == null) {
                        tabla = $('#tabla').DataTable(
                                {
                                    "oLanguage": {
                                        "oPaginate": {
                                            "sNext": "Siguiente",
                                            "sPrevious": "Anterior"
                                        },
                                        "sLengthMenu": "Mostrar _MENU_ Resultados",
                                        "sSearch": "Buscar",
                                        "sZeroRecords": "No se encontraron Resultados",
                                        "sInfo": "Mostrar desde el _START_ hasta el _END_ de un total de _TOTAL_ Resultados",
                                        "sInfoEmpty": "Mostrar desde el 0 Hasta el 0 de un total de 0 Resultados",
                                        "sInfoFiltered": "(Filtrado desde un total de _MAX_ Resultados)"
                                    },
                                }
                        );
                    }
                }
        );
    }
    function editar(id) {
        document.getElementById("fm").reset();
        document.getElementById('accion').value = "ACTUALIZAR_ESTADO";
        document.getElementById('idCompra').value = id;
        $('#modalLabel').html("Editar Estado Compra");
        $('#dg-modela').modal(this)//CALL MODAL MENSAJE        
    }
    function guardarCambioEstado() {
        $.ajax({
            type: "POST",
            url: "../Servlet/administrarCompra.php",
            data: $("#fm").serialize(),
            success: function (result) {
                console.log(result);
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $('#dg-modela').modal('hide')
                    notificacion(result.errorMsg, 'danger', 'alert');
                } else {
                    $('#dg-modela').modal('hide')
                    notificacion(result.mensaje, 'success', 'alert');
                    cargarCompras();
                }
            }
        });
    }

    function ver(id) {
        document.getElementById('idCompra').value = id;
        var msj = "<strong>COMPRA N°: " + id + "</strong>";
        $('#modalLabel2').html(msj);
        $('#dg-modela2').modal(this)//CALL MODAL MENSAJE                                    
        rellenarFormularioMostrar(id);
    }
    function rellenarFormularioMostrar(id) {
        var url_json = '../Servlet/administrarCompra.php';
        $.ajax({
            type: "POST",
            url: url_json,
            data: 'accion=BUSCAR_BY_ID&idCompra=' + id,
            success: function (data) {
                var data = eval('(' + data + ')');
                document.getElementById('fechaCompra').innerHTML = data.fechaCompra;
                document.getElementById('metodoDespacho').innerHTML = data.metodoDespacho;
                document.getElementById('direccionDespacho').innerHTML = data.direccionDespacho;
                document.getElementById('personaRetira').innerHTML = data.personaRetira;
                document.getElementById('estado').innerHTML = data.estado;
                document.getElementById('runCliente').innerHTML = data.run;
            }
        });
        //
        var url_json = '../Servlet/administrarDetalle_compra.php?accion=BUSCAR_All_BY_ID_COMPRA&idCompra=' + id;
        var total = 0;
        $("#detallecompra").html("");
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var subtotal = v.cantidad * v.precio;
                        var contenido = "<tr>";
                        contenido += "<td>" + v.idProducto + "</td>";
                        contenido += "<td>" + v.nombreProducto + "</td>";
                        contenido += "<td>" + v.cantidad + "</td>";
                        contenido += "<td>$ " + v.precio + "</td>";
                        contenido += "<td>$ " + subtotal + "</td>";
                        contenido += "</tr>";
                        total = total + subtotal;
                        $("#detallecompra").append(contenido);
                    });
                    document.getElementById('total').innerHTML = total;
                }

        );


    }

    function confirmacion(titulo, mensaje) {
        document.getElementById('logo-confirmacion').src = "../../Files/img/log.png";
        $('#titulo-confirmacion').html(titulo);
        $('#contenedor-confirmacion').html(mensaje);
        $('#dg-confirmacion').modal(this)//CALL MODAL MENSAJE
    }
    function borrar(id) {
        confirmacion('Confirmacion', '¿Esta seguro?, una vez anulada la compra, no podrá recuperar la información.');
        document.getElementById('idCompraAnulada').value = id;
    }
    function confirmarBorrar() {
        var id = document.getElementById('idCompraAnulada').value;
        $.post('../Servlet/administrarCompra.php?accion=CANCELAR', {idCompra: id}, function (result) {
            if (result.success) {
                $('#dg-confirmacion').modal('toggle'); //Cerrar Modal
                cargarCompras(); //Refrescamos la tabla
                notificacion(result.mensaje, 'success', 'alert');
            } else {
                notificacion(result.errorMsg, 'danger', 'alert');
            }
        }, 'json');
    }


</script>
<!--Middle Part End-->

<?php include("footer.php"); ?>