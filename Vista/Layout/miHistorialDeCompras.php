<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>Mis Compras</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <h5><strong>Compras</strong></h5>

    <hr style="border: orangered 1px solid;">
    <div class="table-responsive">
        <table id="tabla" class="table">
            <thead> 
                <tr> 
                    <th>Id</th> 
                    <th>Fecha Compra</th>
                    <th>Estado</th>
                    <th style="width: 30%">Acción</th>
                </tr> 
            </thead>
            <tbody id="comprasRecientes">

            </tbody>
        </table>
        <input type="hidden"  name="run1" id="run1" value="<?php echo $run; ?>">
    </div>
</div>


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
                                                    <th>Subtotal</th>
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
                        <a class="btn btn-default" data-dismiss="modal">Salir</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END DIALOGO MODAL-->

<script>
    $(function () {
        cargarCompras();
    });
    var tabla = null;

    function cargarCompras() {
        var run = document.getElementById('run1').value;
        $("#comprasRecientes").empty();
        var url_json = '../Servlet/administrarCompra.php?accion=MI_LISTADO&run=' + run;
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var contenido = "<tr>";
                        contenido += "<td>" + v.idCompra + "</td>";
                        contenido += "<td>" + v.fechaCompra + "</td>";
                        contenido += "<td>" + v.estado + "</td>";
                        contenido += "<td>";
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

    function ver(id) {
        document.getElementById('idCompra').value = id;
        var msj = "<strong>MI COMPRA N°: " + id + "</strong>";
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
        //
    }
</script>
<!--Middle Part End-->

<?php include("footer.php"); ?>