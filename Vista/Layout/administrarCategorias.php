<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>ADMINISTRAR CATEGORIAS DE PRODUCTOS</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <div class="col-md-6">
        <h5><strong>CATEGORIAS</strong></h5>
    </div>
    <div class="col-md-6">
        <a onclick="agregarCategoria()" class="btn btn-warning btn-sm" style="float: right;">Agregar Categoria</a>
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
                        <th style="width: 50px;">ID</th> 
                        <th>Nombre</th>
                        <th style="width: 150px;">Accion</th>
                    </tr> 
                </thead>
                <tbody id="tablaCategorias">

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
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-modal" src="../../Files/img/log.png" width="100px" style="float: left;">
                    <label class="titulo-modal" style="width: 200px; padding-top: 50px;"><h4 class="modal-title" id="modalLabel"></h4></label>
                </div>
                <form id="fm" method="POST" >
                    <div class="modal-body">
                        <section class="row">                            
                            <section class="col-md-12">

                                <div id="nombresGroup" class="form-group has-feedback">
                                    <label class="control-label col-md-12" for="nombreCategoria">Nombre Categoria</label>
                                    <input type="text" class="form-control col-md-12" id="nombreCategoria" name="nombreCategoria" aria-describedby="nombresStatus" placeholder="Nombre" >                                    
                                </div>

                                <input type="hidden" value="" name="accion" id="accion">
                                <input type="hidden" value="" name="idCategoria" id="idCategoria">
                            </section>                           
                        </section><!-- Fin Row-->
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                        <a class="btn btn-success" onclick="crearCategora()">Guardar</a>
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
                    <input type="hidden" value="" id="idCategoriaEliminar" name="idCategoriaEliminar">
                </div>
            </section>
        </div>
    </div>
</div><!-- END MODAL CONFIRMACION-->

<script>
    $(function () {
        cargarCategorias();
    });
    var tabla = null;
    function cargarCategorias() {
        $("#tablaCategorias").empty();
        var url_json = '../Servlet/administrarCategoria.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var contenido = "<tr>";
                        contenido += "<td>" + v.idCategoria + "</td>";
                        contenido += "<td>" + v.nombreCategoria + "</td>";
                        contenido += "<td>";
                        contenido += "<a class='btn btn-warning btn-xs glyphicon glyphicon-pencil'  onclick='editar(" + v.idCategoria + ")'></a>&nbsp;";
                        contenido += "<a class='btn btn-danger btn-xs glyphicon glyphicon-trash'  onclick='borrar(" + v.idCategoria + ")  '></a>&nbsp;";
                        contenido += "<a class='btn btn-info btn-xs glyphicon glyphicon-search'  onclick='ver(" + v.idCategoria + ")'></a>";
                        contenido += "</td>";
                        contenido += "</tr>";
                        $("#tablaCategorias").append(contenido);
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
        document.getElementById('idCategoria').value = id;
        $('#modalLabel').html("Editar Categoria");
        $('#dg-modela').modal(this)//CALL MODAL MENSAJE                                    
        rellenarFormulario(id);
    }

    function rellenarFormulario(id) {
        var url_json = '../Servlet/administrarCategoria.php';
        $.ajax({
            type: "POST",
            url: url_json,
            data: 'accion=BUSCAR_BY_ID&idCategoria=' + id,
            success: function (data) {
                var data = eval('(' + data + ')');
                console.log(data);
                document.getElementById('idCategoria').value = data.idCategoria;
                document.getElementById('nombreCategoria').value = data.nombreCategoria;
            }
        });
    }

    function agregarCategoria() {
        document.getElementById("fm").reset();
        document.getElementById('accion').value = "AGREGAR";
        $('#modalLabel').html("Crear Categoria");
        $('#dg-modela').modal(this)//CALL MODAL MENSAJE
    }

    function crearCategora() {
        if (document.getElementById('nombreCategoria').value != "") {
            $.ajax({
                type: "POST",
                url: "../Servlet/administrarCategoria.php",
                data: $("#fm").serialize(),
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        $('#dg-modela').modal('hide')
                        notificacion(result.errorMsg, 'danger', 'alert');
                    } else {
                        $('#dg-modela').modal('hide')
                        notificacion(result.mensaje, 'success', 'alert');
                        cargarCategorias();
                    }
                }
            });
        } else {
            notificacion("Debe ingresar el nombre de la categoria", 'success', 'alert');
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
        document.getElementById('idCategoriaEliminar').value = id;
    }

    function confirmarBorrar() {
        var id = document.getElementById('idCategoriaEliminar').value;
        $.post('../Servlet/administrarCategoria.php?accion=BORRAR', {idCategoria: id}, function (result) {
            if (result.success) {
                $('#dg-confirmacion').modal('toggle'); //Cerrar Modal
                cargarCategorias();//Refrescamos la tabla
                notificacion(result.mensaje, 'success', 'alert');
            } else {
                notificacion(result.errorMsg, 'danger', 'alert');
            }
        }, 'json');
    }
    
    function ver(idCategoria) {
        window.location = "administrarSubCategorias.php?idCategoria="+idCategoria;
    }
</script>
<!--Middle Part End-->
<?php include("footer.php"); ?>