<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>ADMINISTRAR PRODUCTOS POR SUBCATEGORIA</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <div class="col-md-6">
        <h5><strong>PRODUCTOS</strong></h5>
    </div>
    <div class="col-md-6">
        <a onclick="agregarProducto()" class="btn btn-warning btn-sm" style="float: right;">Agregar Producto</a>
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
                        <th style="">Grafico</th> 
                        <th style="width: 50px;">ID</th> 
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th style="width: 150px;">Accion</th>
                    </tr> 
                </thead>
                <tbody id="contenidoTabla">

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
                    <img id="logo-modal" src="../../Files/img/log.png" width="50px" style="float: left;">
                    <label class="titulo-modal" style="width: 200px; padding-top: 10px;"><h4 class="modal-title" id="modalLabel"></h4></label>
                </div>
                <form id="fm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <section class="row"> 
                            <div id="alert-modal"></div>
                            <section class="col-md-12">
                                <div id="nombresGroup" class="form-group has-feedback">
                                    <label class="control-label col-md-12" for="nombreProducto">Nombre Producto</label>
                                    <input type="text" class="form-control col-md-12" id="nombreProducto" name="nombreProducto" aria-describedby="" placeholder="Nombre" >                                    
                                </div>
                                <div id="nombresGroup" class="form-group has-feedback">
                                    <label class="control-label col-md-12" for="descripcionProducto">Descripcion Producto</label>
                                    <input type="text" class="form-control col-md-12" id="descripcionProducto" name="descripcionProducto" aria-describedby="" placeholder="Descripcion" >                                    
                                </div>
                                <div id="nombresGroup" class="form-group has-feedback">
                                    <label class="control-label col-md-12" for="stock">Stock</label>
                                    <input type="number" class="form-control col-md-12" id="stock" name="stock" aria-describedby="" placeholder="" >                                    
                                </div>
                                <div id="nombresGroup" class="form-group has-feedback">
                                    <label class="control-label col-md-12" for="precio">Precio</label>
                                    <input type="number" class="form-control col-md-12" id="precio" name="precio" aria-describedby="" placeholder="$" >                                    
                                </div>
                                <div id="nombresGroup" class="form-group has-feedback">
                                    <label class="control-label col-md-12" for="idSubCategoria">Subcategoria</label>
                                    <select class="form-control col-md-12" id="idSubCategoria" name="idSubCategoria" aria-describedby="" ></select>
                                </div>
                                <div id="nombresGroup" class="form-group has-feedback">
                                    <label class="control-label col-md-12" for="imagen">Imagen</label>
                                    <input type="file" class="form-control col-md-12" id="imagen" name="imagen" aria-describedby="" placeholder="" >
                                </div>
                                <input type="hidden" value="" name="accion" id="accion">
                                <input type="hidden" value="" name="idSubCategoria" id="idSubCategoria">
                            </section>                           
                        </section><!-- Fin Row-->
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                        <a class="btn btn-warning" onclick="guardar()">Guardar</a>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div><!-- END DIALOGO MODAL-->

<script>
    $(function () {
        cargar();
    });
    function cargar() {
        $("#contenidoTabla").empty();
        var url_json = '../Servlet/administrarProducto.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var contenido = "<tr>";
                        contenido += "<td>" + v.rutaImagen + "</td>";
                        contenido += "<td>" + v.idProducto + "</td>";
                        contenido += "<td>" + v.nombreProducto + "</td>";
                        contenido += "<td>" + v.descripcionProducto + "</td>";
                        contenido += "<td>" + v.stock + "</td>";
                        contenido += "<td>" + v.precio + "</td>";
                        contenido += "<td>";
                        contenido += "<a class='btn btn-warning btn-xs glyphicon glyphicon-pencil'  onclick='editar(" + v.idCategoria + ")'></a>&nbsp;";
                        contenido += "<a class='btn btn-danger btn-xs glyphicon glyphicon-trash'  onclick='borrar(" + v.idCategoria + ")  '></a>&nbsp;";
                        contenido += "<a class='btn btn-info btn-xs glyphicon glyphicon-search'  onclick='ver(" + v.idCategoria + ")'></a>";
                        contenido += "</td>";
                        contenido += "</tr>";
                        $("#contenidoTabla").append(contenido);
                    });
                    $('#tabla').DataTable();
                }
        );
    }

    function cargar() {
        $("#idSubCategoria").empty();
        $("#idSubCategoria").append("<option value='0'> Seleccionar </option>");
        var url_json = '../Servlet/administrarSubcategoria.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        $("#idSubCategoria").append("<option value='" + v.idSubCategoria + "'> " + v.nombreSubCategoria + "</option>");
                    });
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
        var url_json = '../Servlet/administrarProducto.php';
        $.ajax({
            type: "POST",
            url: url_json,
            data: 'accion=BUSCAR_BY_ID&idProducto=' + id,
            success: function (data) {
                var data = eval('(' + data + ')');
                console.log(data);
                document.getElementById('idProducto').value = data.idProducto;
                document.getElementById('nombreProducto').value = data.nombreProducto;
            }
        });
    }

    function agregarProducto() {
        document.getElementById("fm").reset();
        document.getElementById('accion').value = "AGREGAR";
        $('#modalLabel').html("Crear Producto");
        $('#dg-modela').modal(this)//CALL MODAL MENSAJE
    }

    function guardar() {
        if (validar()) {
            console.log("valido");
            /*$.ajax({
             type: "POST",
             url: "../Servlet/administrarProducto.php",
             data: $("#fm").serialize(),
             success: function (result) {
             var result = eval('(' + result + ')');
             if (result.errorMsg) {
             $('#dg-modela').modal('hide')
             notificacion(result.errorMsg, 'danger', 'alert');
             } else {
             $('#dg-modela').modal('hide')
             notificacion(result.mensaje, 'success', 'alert');
             cargar();
             }
             }
             });*/
        } else {
            console.log("invalido");
        }
    }

    function validar() {
        if (document.getElementById("nombreProducto").value == "") {
            notificacion("Debe ingresar el nombre del producto", 'warning', 'alert-modal');
            return false;
        } else if (document.getElementById("descripcionProducto").value == "") {
            notificacion("Debe ingresar la descripcion del producto", 'warning', 'alert-modal');
            return false;
        } else if (document.getElementById("stock").value == "") {
            notificacion("Debe ingresar el stock del producto", 'warning', 'alert-modal');
            return false;
        } else if (document.getElementById("precio").value == "") {
            notificacion("Debe ingresar el precio del producto", 'warning', 'alert-modal');
            return false;
        } else if (document.getElementById("idSubCategoria").value == 0) {
            notificacion("Debe seleccionar una subcategoria", 'warning', 'alert-modal');
            return false;
        } else if (document.getElementById("imagen").value == "") {
            notificacion("Debe seleccionar una imagen", 'warning', 'alert-modal');
            return false;
        }

        return true;
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
        window.location = "administrarSubCategorias.php?idCategoria=" + idCategoria;
    }
</script>
<?php include("footer.php"); ?>
