<?php include("headerAdmin.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>Historial de Ventas</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <h5><strong>Ventas</strong></h5>

    <hr style="border: orangered 1px solid;">
    <div class="table-responsive">
        <table id="tabla" class="table">
            <thead> 
                <tr> 
                    <th>Id Compra</th> 
                    <th>Fecha Compra</th>
                    <th>Estado</th>
                    <th style="width: 30%">Acción</th>
                </tr> 
            </thead>
            <tbody id="comprasRecientes">

            </tbody>
        </table>
    </div>
</div>


<!-- DIALOGO MODAL cambiar estado-->
<div class="modal fade bs-example-modal-md" id="dg-modela" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header" style=" border: orangered 1px solid; border-radius: 15px; text-align: center ; margin:  1%;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-modal" src="../../Files/img/log.png" width="60px" style="float: left;">
                    <label class="titulo-modal" style="width: 300px; padding-top: 20px;"><h4 class="modal-title" id="modalLabel"></h4></label>
                </div>
                <form id="fm" method="POST" class="form-horizontal">
                    <div style="margin: 1%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                        <div class="modal-body">
                            <section class="row">   
                                <div class="alert"></div>
                                <section class="col-md-12">
                                    <div id="nombresGroup" class="form-group has-feedback">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="estado1">Estado de la Compra</label>                                    
                                            <div class="col-sm-6">
                                                <select  class="form-control" id="estado1" name="estado1" required > 
                                                    <option value="En Origen">En Origen</option>
                                                    <option value="En Reparto">En Reparto</option>
                                                    <option value="Finalizado">Finalizado</option>
                                                </select> 
                                            </div>
                                        </div> 

                                        <input type="hidden" value="" name="accion" id="accion">
                                        <input type="hidden" value="" name="idCompra" id="idCompra">
                                    </div>
                                </section>                           
                            </section><!-- Fin Row-->
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                            <a class="btn btn-warning" onclick="guardarCambioEstado()">Guardar</a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div><!-- END DIALOGO MODAL-->

<!-- DIALOGO MODAL FICHA-->
<div class="modal fade bs-example-modal-md" id="dg-modela2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header" style=" border: orangered 1px solid; border-radius: 15px; text-align: center ; margin:  1%;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-modal" src="../../Files/img/log.png" width="60px" style="float: left;">
                    <label class="titulo-modal" style="width: 300px; padding-top: 25px; text-align: center"><h4 class="modal-title" id="modalLabel2"></h4></label>
                </div>
                <div style="margin: 1%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                    <div class="modal-body">
                        <section class="row">                            
                            <section class="col-md-12">
                                <div id="nombresGroup" class="form-horizontal has-feedback">
                                    <h5><strong>DATOS DEL DESPACHO</strong></h5>
                                    <hr style="border: orangered 1px solid;"> 
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="runCliente">Run del Cliente:</label>
                                        <div class="col-sm-6" >
                                            <h7 class="col-sm-8" style="padding-top: 7px" id="runCliente" name= "runCliente"></h7>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="fechaCompra">Fecha Compra:</label>
                                        <div class="col-sm-6">
                                            <h7 class="col-sm-8" style="padding-top: 7px" id="fechaCompra" name= "fechaCompra"></h7>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="metodoDespacho">Metodo Despacho:</label>
                                        <div class="col-sm-6">
                                            <h7 class="col-sm-8" style="padding-top: 7px" id="metodoDespacho" name= "metodoDespacho"></h7>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="direccionDespacho">Dirección de Despacho:</label>
                                        <div class="col-sm-6">
                                            <h7 class="col-sm-8" id="direccionDespacho" style="padding-top: 7px" name= "direccionDespacho"></h7>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="personaRetira">Persona que Retira:</label>
                                        <div class="col-sm-6">
                                            <h7 class="col-sm-8" id="personaRetira" style="padding-top: 7px" name= "personaRetira"></h7>
                                        </div>
                                    </div>  
                                    <div class="form-group" >
                                        <label class="col-sm-4 control-label" for="estado">Estado:</label>
                                        <div class="col-sm-6">
                                            <h7 class="col-sm-8" id="estado" style="padding-top: 7px" name= "estado"></h7>
                                        </div>
                                    </div>  
                                    <hr style="border: orangered 1px solid;">
                                    <h5><strong>DETALLE DE LA COMPRA</strong></h5>
                                    <hr style="border: orangered 1px solid;">
                                    <div class="table-responsive">
                                        <table id="tablaDetalle" class="table">
                                            <thead> 
                                                <tr> 
                                                    <th>Id Producto</th> 
                                                    <th>Nombre Producto</th> 
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>SubTotal</th>                                                        
                                                </tr> 
                                            </thead>
                                            <tbody id="detallecompra">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="" style="text-align: right ;" >
                                        <h7 class="" for="total"><strong>Total:</strong></h7>
                                        <h7 class="" id="total" name= "total"></h7>
                                    </div> 
                                </div>
                                <input type="hidden" value="" name="accion" id="accion">
                                <input type="hidden" value="" name="idCompra" id="idCompra">
                            </section>                           
                        </section><!-- Fin Row-->
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-warning  glyphicon glyphicon-print" onclick="generarPdf()">&nbsp;Comprobante</a>
                        <a class="btn btn-default glyphicon glyphicon-off" data-dismiss="modal">&nbsp;Salir</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END DIALOGO MODAL-->
<!-- MODAL CONFIRMACION-->
<div class="modal fade bs-example-modal-sm" id="dg-confirmacion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-confirmacion" src="../../Files/img/log.png" width="50px">
                    <label class="titulo-modal"><h4 class="modal-title" id="titulo-mensaje"></h4></label>
                </div>
                <div class="modal-body">
                    <section class="row">
                        <section class="col-md-12">
                            <div id="contenedor-confirmacion">

                            </div>
                        </section>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarBorrar()">Borrar</button>
                    <input type="hidden" value="" id="idCompraAnulada" name="idCompraAnulada">
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END MODAL CONFIRMACION-->

<script>
    $(function () {
        cargarCompras();
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
    function generarPdf() {
    var idCompra = document.getElementById('idCompra').value;
        window.open("generarPdfDetalleCompra.php?" + "&idCompra=" + idCompra );
    }

</script>
<!--Middle Part End-->

<?php include("footer.php"); ?>