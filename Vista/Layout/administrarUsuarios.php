<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>Administrar Usuarios</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <h5><strong>USUARIOS</strong></h5>
    <hr style="border: orangered 1px solid;">
    <div id="alert"></div>
    <div class="table-responsive">
        <table id="tabla" class="table">
            <thead> 
                <tr> 
                    <th>Run</th> 
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Acción</th>
                </tr> 
            </thead>
            <tbody id="tablaUsuarios">

            </tbody>
        </table>
    </div>
</div>

<!-- DIALOGO MODAL Editar-->
<div class="modal fade bs-example-modal-md" id="dg-modela" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header" style=" border: orangered 1px solid; border-radius: 15px; text-align: center ; margin:  1%;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-modal" src="../../Files/img/log.png" width="60px" style="float: left;">
                    <label class="titulo-modal" style="width: 200px; padding-top: 25px; text-align: center"><h4 class="modal-title" id="modalLabel"></h4></label>
                </div>
                <form id="fm" class="form-horizontal" method="POST" >
                    <div style="margin: 1%; align-content: center; border: orangered 1px solid; border-radius: 15px;">                       
                        <div class="modal-body">
                            <section class="row">
                                <div id="alert-modal"></div>
                                <section class="col-md-12">
                                    <div id="nombresGroup" class="form-group has-feedback">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="runUsuario">Run</label>
                                            <div class="col-sm-6">
                                                <input class="form-control " id="runUsuario" name="runUsuario" type="text" placeholder="112223337" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="nombresUsuario">Nombres</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="nombresUsuario" name="nombresUsuario" type="text">                                     
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="apellidosUsuario">Apellidos</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="apellidosUsuario" name="apellidosUsuario" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="emailUsuario"><strong>E-Mail</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="emailUsuario" name="emailUsuario" type="text" placeholder="ejemplo@celeste.cl">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="sexo">Sexo</label>
                                            <div class="col-sm-8">
                                                <div class="col-md-4">
                                                    <input  type="radio" id="sexoM" name="sexo" value="Masculino" checked="checked" >&nbsp;&nbsp;Masculino
                                                </div>
                                                <div class="col-md-4">
                                                    <input  type="radio" id="sexoF" name="sexo" value="Femenino" >&nbsp;&nbsp;Femenino
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="telefonoUsuario">Telefono</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="telefonoUsuario" name="telefonoUsuario" type="text" placeholder="Ej: 988776655">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="direccionUsuario">Dirección</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="direccionUsuario" name="direccionUsuario" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="idPerfil">Perfil de Usuario</label>                                    
                                            <div class="col-sm-6">
                                                <select  class="form-control" id="idPerfil" name="idPerfil" required >                                        
                                                </select> 
                                            </div>
                                        </div>                                    
                                    </div>
                                    <input type="hidden" value="" name="accion" id="accion">
                                    <input type="hidden" value="" name="runEditar" id="runEditar">
                                </section>                           
                            </section><!-- Fin Row-->
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" data-dismiss="modal">Cancelar</a>
                            <a class="btn btn-warning" onclick="guardarUsuario()">Guardar</a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<!-- END DIALOGO MODAL-->

<!-- DIALOGO MODAL FICHA-->
<div class="modal fade bs-example-modal-md" id="dg-modela2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header" style=" border: orangered 1px solid; border-radius: 15px; text-align: center ; margin:  1%;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-modal" src="../../Files/img/log.png" width="60px" style="float: left;">
                    <label class="titulo-modal" style="width: 200px; padding-top: 25px; text-align: center"><h4 class="modal-title" id="modalLabel2"></h4></label>
                </div>
                <form id="fm2" class="form-horizontal" method="POST" >
                    <div style="margin: 1%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                        <div class="modal-body">
                            <section class="row">                            
                                <section class="col-md-12">
                                    <div id="nombresGroup" class="form-group has-feedback">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="runUsuario2">Run:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control " id="runUsuario2" name="runUsuario2" type="text" placeholder="112223337" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="nombresUsuario2">Nombres:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="nombresUsuario2" name="nombresUsuario2" type="text" readonly="true">                                     
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="apellidosUsuario2">Apellidos:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="apellidosUsuario2" name="apellidosUsuario2" type="text" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="emailUsuario2"><strong>E-Mail:</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="emailUsuario2" name="emailUsuario2" type="text" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="sexo2">Sexo:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="sexo2" name="sexo2" type="text"  readonly="true">
                                            </div>  
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="telefonoUsuario2">Telefono:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="telefonoUsuario2" name="telefonoUsuario2" type="text" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="direccionUsuario2">Dirección:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="direccionUsuario2" name="direccionUsuario2" type="text" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="nombrePerfil2">Perfil de Usuario:</label>                                    
                                            <div class="col-sm-6">                                      
                                                <input class="form-control" id="nombrePerfil2" name="nombrePerfil2" type="text" readonly="true">
                                            </div>
                                        </div>                                    
                                    </div>
                                    <input type="hidden" value="" name="accion2" id="accion2">
                                    <input type="hidden" value="" name="runVer" id="runVer">
                                </section>                           
                            </section><!-- Fin Row-->
                        </div>

                        <div class="modal-footer">
                            <a class="btn btn-default" data-dismiss="modal">Salir</a>
                        </div>
                    </div>
                </form>
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
                    <input type="hidden" value="" id="runUsuarioEliminar" name="runUsuarioEliminar">
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END MODAL CONFIRMACION-->

<script>
    $(function () {
        cargarPerfiles();
        cargarUsuarios();
    });
    var tabla = null;
    function cargarUsuarios() {
        $("#tablaUsuarios").empty();
        var url_json = '../Servlet/administrarUsuario.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var nombreCompleto = v.nombres + " " + v.apellidos;
                        var contenido = "<tr>";
                        contenido += "<td>" + v.run + "</td>";
                        contenido += "<td>" + nombreCompleto + "</td>";
                        contenido += "<td>" + v.telefono + "</td>";
                        contenido += "<td>" + v.direccion + "</td>";
                        contenido += "<td>";
                        contenido += "<a class='btn btn-warning btn-xs glyphicon glyphicon-pencil'  onclick='editar(" + v.run + ")'></a>&nbsp;";
                        contenido += "<a class='btn btn-danger btn-xs glyphicon glyphicon-trash'  onclick='borrar(" + v.run + ")  '></a>&nbsp;";
                        contenido += "<a class='btn btn-info btn-xs glyphicon glyphicon-search'  onclick='ver(" + v.run + ")'></a>";
                        contenido += "</td>";
                        contenido += "</tr>";
                        $("#tablaUsuarios").append(contenido);
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
        document.getElementById('runEditar').value = id;
        $('#modalLabel').html("Editar Usuario");
        $('#dg-modela').modal(this)//CALL MODAL MENSAJE                                    
        rellenarFormulario(id);
    }
    function ver(id) {
        document.getElementById("fm2").reset();
//        document.getElementById('accion').value = "ACTUALIZAR";
        document.getElementById('runVer').value = id;
        $('#modalLabel2').html("Ver Usuario");
        $('#dg-modela2').modal(this)//CALL MODAL MENSAJE                                    
        rellenarFormularioMostrar(id);
    }
    function rellenarFormularioMostrar(id) {
        var url_json = '../Servlet/administrarUsuario.php';
        $.ajax({
            type: "POST",
            url: url_json,
            data: 'accion=BUSCAR_BY_ID&run=' + id,
            success: function (data) {
                var data = eval('(' + data + ')');
                document.getElementById('runUsuario2').value = data.run;
                document.getElementById('nombresUsuario2').value = data.nombres;
                document.getElementById('apellidosUsuario2').value = data.apellidos;
                document.getElementById('emailUsuario2').value = data.correoElectronico;
                if (data.sexo.localeCompare("F") == 0) {
                    document.getElementById("sexo2").value = "Femenino";
                } else {
                    document.getElementById("sexo2").value = "Masculino";
                }

                document.getElementById('telefonoUsuario2').value = data.telefono;
                document.getElementById('direccionUsuario2').value = data.direccion;
                document.getElementById('nombrePerfil2').value = data.nombrePerfil;
            }
        });
    }
    function rellenarFormulario(id) {
        var url_json = '../Servlet/administrarUsuario.php';
        $.ajax({
            type: "POST",
            url: url_json,
            data: 'accion=BUSCAR_BY_ID&run=' + id,
            success: function (data) {
                var data = eval('(' + data + ')');
                document.getElementById('runUsuario').value = data.run;
                document.getElementById('nombresUsuario').value = data.nombres;
                document.getElementById('apellidosUsuario').value = data.apellidos;
                document.getElementById('emailUsuario').value = data.correoElectronico;
                if (data.sexo.localeCompare("F") == 0) {
                    document.getElementById("sexoF").checked = true;
                } else {
                    document.getElementById("sexoM").checked = true;
                }
                document.getElementById('telefonoUsuario').value = data.telefono;
                document.getElementById('direccionUsuario').value = data.direccion;
                document.getElementById('idPerfil').value = data.idPerfil;
            }
        });
    }
    function cargarPerfiles() {
        var url_json = '../Servlet/administrarPerfil.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var contenido = "<option value='" + v.idPerfil + "'>" + v.nombrePerfil + "</option>";
                        $("#idPerfil").append(contenido);
                    });
                }
        );
    }
    function guardarUsuario() {
        if (validarUsuarioEditar()) {
            $.ajax({
                type: "POST",
                url: "../Servlet/administrarUsuario.php",
                data: $("#fm").serialize(),
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        $('#dg-modela').modal('hide')
                        notificacion(result.errorMsg, 'danger', 'alert-modal');
                    } else {
                        $('#dg-modela').modal('hide')
                        notificacion(result.mensaje, 'success', 'alert-modal');
                        cargarUsuarios();
                        // document.location = "administrarUsuarios.php";
                    }
                }
            });
        }
    }
    function confirmacion(titulo, mensaje) {
        document.getElementById('logo-confirmacion').src = "../../Files/img/log.png";
        $('#titulo-confirmacion').html(titulo);
        $('#contenedor-confirmacion').html(mensaje);
        $('#dg-confirmacion').modal(this)//CALL MODAL MENSAJE
    }
    function borrar(id) {
        confirmacion('Confirmacion', '¿Esta seguro?, una vez eliminado el usuario no se podrá recuperar.');
        document.getElementById('runUsuarioEliminar').value = id;
    }
    function confirmarBorrar() {
        var id = document.getElementById('runUsuarioEliminar').value;
        $.post('../Servlet/administrarUsuario.php?accion=BORRAR', {run: id}, function (result) {
            if (result.success) {
                console.log(result);
                $('#dg-confirmacion').modal('toggle'); //Cerrar Modal
                cargarUsuarios(); //Refrescamos la tabla
                notificacion(result.mensaje, 'success', 'alert');
            } else {
                notificacion(result.errorMsg, 'danger', 'alert');
            }
        }, 'json');
    }


</script>
<!--Middle Part End-->
<?php include("footer.php"); ?>