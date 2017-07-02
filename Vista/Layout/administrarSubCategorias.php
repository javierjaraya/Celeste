<?php
include("headerAdmin.php");
$idCategoria = $_REQUEST['idCategoria'];
$nombreCategoria = $_REQUEST['nombreCategoria'];
?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>ADMINISTRAR SUBCATEGORIAS DE PRODUCTOS</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <div class="col-md-6">
        <h5><strong>SUBCATEGORIAS:&nbsp;&nbsp;<?= $nombreCategoria ?></strong></h5>
    </div>
    <div class="col-md-6">
        <a onclick="agregarSubcategoria()" class="btn btn-warning btn-sm" style="float: right;">Agregar Subcategoria</a>
    </div>
    <div class="col-md-12">
        <hr style="border: orangered 1px solid;">
        <div id="alert"></div>    
    </div>    
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="tabla" class="table">
                <thead> 
                    <tr> 
                        <th style="width: 50px;">Id</th> 
                        <th>Nombre</th>
                        <th style="width: 150px;">Acción</th>
                    </tr> 
                </thead>
                <tbody id="tablaSubCategorias">

                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- DIALOGO MODAL-->
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
                                <section class="col-md-12">
                                    <div id="nombresGroup" class="form-group has-feedback">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="nombreSubCategoria">Nombre Subcategoria</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control col-md-12" id="nombreSubCategoria" name="nombreSubCategoria" placeholder="Nombre" >
                                            </div>
                                        </div>
                                        <input type="hidden" value="" name="accion" id="accion">
                                        <input type="hidden" value="" name="idSubCategoria" id="idSubCategoria">
                                        <input type="hidden" value="<?= $idCategoria ?>" name="idCategoria" id="idCategoria">
                                    </div>
                                </section>                           
                            </section><!-- Fin Row-->
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                            <a class="btn btn-warning" onclick="crearSubcategora()">Guardar</a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div><!-- END DIALOGO MODAL-->

<!-- MODAL CONFIRMACION-->
<div class="modal fade bs-example-modal-sm" id="dg-confirmacion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-confirmacion" src="../../Files/img/log.png" width="100px">
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
                    <input type="hidden" value="" id="idSubCategoriaEliminar" name="idSubCategoriaEliminar">
                </div>
            </section>
        </div>
    </div>
</div><!-- END MODAL CONFIRMACION-->

<script>
    $(function () {
        cargarSubcategorias();
    });
    var tabla = null;
    function cargarSubcategorias() {
        var idCategoria = document.getElementById('idCategoria').value;
        $("#tablaSubCategorias").empty();
        var url_json = '../Servlet/administrarSubcategoria.php?accion=LISTADO_BY_IDCATEGORIA&idCategoria=' + idCategoria;
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var contenido = "<tr>";
                        contenido += "<td>" + v.idSubCategoria + "</td>";
                        contenido += "<td>" + v.nombreSubCategoria + "</td>";
                        contenido += "<td>";
                        contenido += "<a class='btn btn-warning btn-xs glyphicon glyphicon-pencil'  onclick='editar(" + v.idSubCategoria + ")'></a>&nbsp;";
                        contenido += "<a class='btn btn-danger btn-xs glyphicon glyphicon-trash'  onclick='borrar(" + v.idSubCategoria + ")  '></a>";
                        contenido += "</td>";
                        contenido += "</tr>";
                        $("#tablaSubCategorias").append(contenido);
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
        document.getElementById('accion').value = "ACTUALIZAR";
        document.getElementById('idSubCategoria').value = id;
        $('#modalLabel').html("Editar Subcategoria");
        $('#dg-modela').modal(this)//CALL MODAL MENSAJE                                    
        rellenarFormulario(id);
    }

    function rellenarFormulario(id) {
        var url_json = '../Servlet/administrarSubcategoria.php';
        $.ajax({
            type: "POST",
            url: url_json,
            data: 'accion=BUSCAR_BY_ID&idSubCategoria=' + id,
            success: function (data) {
                console.log(data);
                var data = eval('(' + data + ')');
                console.log(data);
                document.getElementById('idSubCategoria').value = data.idSubCategoria;
                document.getElementById('nombreSubCategoria').value = data.nombreSubCategoria;
            }
        });
    }

    function agregarSubcategoria() {
        document.getElementById("fm").reset();
        document.getElementById('accion').value = "AGREGAR";
        $('#modalLabel').html("Crear Subcategoria");
        $('#dg-modela').modal(this)//CALL MODAL MENSAJE
    }

    function crearSubcategora() {
        if (document.getElementById('nombreSubCategoria').value != "") {
            $.ajax({
                type: "POST",
                url: "../Servlet/administrarSubcategoria.php",
                data: $("#fm").serialize(),
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        $('#dg-modela').modal('hide')
                        notificacion(result.errorMsg, 'danger', 'alert');
                    } else {
                        $('#dg-modela').modal('hide')
                        notificacion(result.mensaje, 'success', 'alert');
                        cargarSubcategorias();
                    }
                }
            });
        } else {
            notificacion("Debe ingresar el nombre de la subcategoria", 'success', 'alert');
        }
    }

    function confirmacion(titulo, mensaje) {
        document.getElementById('logo-confirmacion').src = "../../Files/img/log.png";
        $('#titulo-confirmacion').html(titulo);
        $('#contenedor-confirmacion').html(mensaje);
        $('#dg-confirmacion').modal(this)//CALL MODAL MENSAJE
    }

    function borrar(id) {
        confirmacion('Confirmacion', '¿Esta seguro?, una vez eliminado no se podran recuperar los datos.');
        document.getElementById('idSubCategoriaEliminar').value = id;
    }

    function confirmarBorrar() {
        var id = document.getElementById('idSubCategoriaEliminar').value;
        $.post('../Servlet/administrarSubcategoria.php?accion=BORRAR', {idSubCategoria: id}, function (result) {
            if (result.success) {
                $('#dg-confirmacion').modal('toggle'); //Cerrar Modal
                cargarSubcategorias();//Refrescamos la tabla
                notificacion(result.mensaje, 'success', 'alert');
            } else {
                notificacion(result.errorMsg, 'danger', 'alert');
            }
        }, 'json');
    }
</script>
<!--Middle Part End-->
<?php include("footer.php"); ?>