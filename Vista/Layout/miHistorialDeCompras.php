<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>Historial de Compras</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <h5><strong>Compras Recientes</strong></h5>
    <hr style="border: orangered 1px solid;">
    <div id="alert1"></div>
    <div class="table-responsive">
        <table id="tabla" class="table">
            <thead> 
                <tr> 
                    <th>Id</th> 
                    <th>Fecha Compra</th>
                    <th>Monto Total</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr> 
            </thead>
            <tbody id="comprasRecientes">

            </tbody>
        </table>
    </div>
</div>

<script>
    $(function () {        
        cargarUsuarios();
    });
    var tabla = null;
    
    function cargarUsuarios() {
        $("#comprasRecientes").empty();
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
//    function editar(id) {
//        document.getElementById("fm").reset();
//        document.getElementById('accion').value = "ACTUALIZAR";
//        document.getElementById('runEditar').value = id;
//        $('#modalLabel').html("Editar Usuario");
//        $('#dg-modela').modal(this)//CALL MODAL MENSAJE                                    
//        rellenarFormulario(id);
//    }
//    function ver(id) {
//        document.getElementById("fm2").reset();
////        document.getElementById('accion').value = "ACTUALIZAR";
//        document.getElementById('runVer').value = id;
//        $('#modalLabel2').html("Ver Usuario");
//        $('#dg-modela2').modal(this)//CALL MODAL MENSAJE                                    
//        rellenarFormularioMostrar(id);
//    }
//    function rellenarFormularioMostrar(id) {
//        var url_json = '../Servlet/administrarUsuario.php';
//        $.ajax({
//            type: "POST",
//            url: url_json,
//            data: 'accion=BUSCAR_BY_ID&run=' + id,
//            success: function (data) {
//                var data = eval('(' + data + ')');
//                document.getElementById('runUsuario2').value = data.run;
//                document.getElementById('nombresUsuario2').value = data.nombres;
//                document.getElementById('apellidosUsuario2').value = data.apellidos;
//                document.getElementById('emailUsuario2').value = data.correoElectronico;
//                if (data.sexo.localeCompare("F") == 0) {
//                    document.getElementById("sexo2").value = "Femenino";
//                } else {
//                    document.getElementById("sexo2").value = "Masculino";
//                }
//
//                document.getElementById('telefonoUsuario2').value = data.telefono;
//                document.getElementById('direccionUsuario2').value = data.direccion;
//                document.getElementById('nombrePerfil2').value = data.nombrePerfil;
//            }
//        });
//    }
//    function rellenarFormulario(id) {
//        var url_json = '../Servlet/administrarUsuario.php';
//        $.ajax({
//            type: "POST",
//            url: url_json,
//            data: 'accion=BUSCAR_BY_ID&run=' + id,
//            success: function (data) {
//                var data = eval('(' + data + ')');
//                document.getElementById('runUsuario').value = data.run;
//                document.getElementById('nombresUsuario').value = data.nombres;
//                document.getElementById('apellidosUsuario').value = data.apellidos;
//                document.getElementById('emailUsuario').value = data.correoElectronico;
//                if (data.sexo.localeCompare("F") == 0) {
//                    document.getElementById("sexoF").checked = true;
//                } else {
//                    document.getElementById("sexoM").checked = true;
//                }
//                document.getElementById('telefonoUsuario').value = data.telefono;
//                document.getElementById('direccionUsuario').value = data.direccion;
//                document.getElementById('idPerfil').value = data.idPerfil;
//            }
//        });
//    }
//
//    function cargarPerfiles() {
//        var url_json = '../Servlet/administrarPerfil.php?accion=LISTADO';
//        $.getJSON(
//                url_json,
//                function (datos) {
//                    $.each(datos, function (k, v) {
//                        var contenido = "<option value='" + v.idPerfil + "'>" + v.nombrePerfil + "</option>";
//                        $("#idPerfil").append(contenido);
//                    });
//                }
//        );
//    }
//    function guardarUsuario() {
//        if (validarUsuarioEditar()) {
//            $.ajax({
//                type: "POST",
//                url: "../Servlet/administrarUsuario.php",
//                data: $("#fm").serialize(),
//                success: function (result) {
//                    var result = eval('(' + result + ')');
//                    if (result.errorMsg) {
//                        $('#dg-modela').modal('hide')
//                        notificacion(result.errorMsg, 'danger', 'alert-modal');
//                    } else {
//                        $('#dg-modela').modal('hide')
//                        notificacion(result.mensaje, 'success', 'alert-modal');
//                        cargarUsuarios();
//                        // document.location = "administrarUsuarios.php";
//                    }
//                }
//            });
//        }
//    }
//    function confirmacion(titulo, mensaje) {
//        document.getElementById('logo-confirmacion').src = "../../Files/img/log.png";
//        $('#titulo-confirmacion').html(titulo);
//        $('#contenedor-confirmacion').html(mensaje);
//        $('#dg-confirmacion').modal(this)//CALL MODAL MENSAJE
//    }
//    function borrar(id) {
//        confirmacion('Confirmacion', '¿Esta seguro?, una vez eliminado el usuario no se podrá recuperar.');
//        document.getElementById('runUsuarioEliminar').value = id;
//    }
//    function confirmarBorrar() {
//        var id = document.getElementById('runUsuarioEliminar').value;
//        $.post('../Servlet/administrarUsuario.php?accion=BORRAR', {run: id}, function (result) {
//            if (result.success) {
//                $('#dg-confirmacion').modal('toggle'); //Cerrar Modal
//                cargarUsuarios(); //Refrescamos la tabla
//                notificacion(result.mensaje, 'success', 'alert');
//            } else {
//                notificacion(result.errorMsg, 'danger', 'alert');
//            }
//        }, 'json');
//    }


</script>
<!--Middle Part End-->

<?php include("footer.php"); ?>