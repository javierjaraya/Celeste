<?php include("header.php"); ?>
<?php include("seguridad.php"); ?>


<div class="col-md-12">
    <div class="row" >         
        <h3 style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%;"><strong>Editar Mi Perfil</strong></h3>
        <div style="padding: 3%; margin-bottom: 1%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
            <div id="alert"></div>
            <form id="fmusuario" class="form-horizontal" method="post" >
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="runUsuario">Run(*)</label>
                    <div class="col-sm-6">
                        <input class="form-control " id="runUsuario" name="runUsuario" type="text" placeholder="112223337" readonly="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="nombresUsuario">Nombres (*)</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="nombresUsuario" name="nombresUsuario" type="text">                                     
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="apellidosUsuario">Apellidos (*)</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="apellidosUsuario" name="apellidosUsuario" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="emailUsuario"><strong>E-Mail (*)</strong></label>
                    <div class="col-sm-6">
                        <input class="form-control" id="emailUsuario" name="emailUsuario" type="text" placeholder="ejemplo@celeste.cl">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="sexo">Sexo (*)</label>
                    <div class="col-sm-6">
                        <div class="col-md-3">
                            <input  type="radio" id="sexoM" name="sexo" value="Masculino" checked="checked" >&nbsp;&nbsp;Masculino
                        </div>
                        <div class="col-md-3">
                            <input  type="radio" id="sexoF" name="sexo" value="Femenino" >&nbsp;&nbsp;Femenino
                        </div>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="telefonoUsuario">Telefono (*)</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="telefonoUsuario" name="telefonoUsuario" type="text" placeholder="Ej: 988776655">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="direccionUsuario">Dirección (*)</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="direccionUsuario" name="direccionUsuario" type="text">
                    </div>
                </div>
                <div class="form-group" style="text-align: center">
                    <div class="col-sm-offset-2 col-sm-9">
                        <a onclick="guardarUsuario()" class="btn btn-warning"><i class="icon icon-next"> </i> Actualizar mis Datos</a>
                    </div>
                </div>   
                <input type="hidden" class="form-control" id="runEditar" name="runEditar" type="text" value="<?php echo $run; ?>">
                <input type="hidden" id="idPerfil" name="idPerfil" value=>
                <input type="hidden" class="form-control" id="accion" name="accion" type="text">
            </form>
            <div>                

                <hr style="border: orangered 1px solid;">
                <h4 style="text-align: center"><strong>Cambiar Contraseña</strong></h4>
                <hr style="border: orangered 1px solid;">
                <div id="alert2"></div>
                <form id="fmContraseña" class="form-horizontal" method="post" >
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="contrasenaUsuario">Contraseña Actual (*)</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="password" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese una clave entre 4 y 8 digitos">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="nuevaContrasenaUsuario">Ingrese Nueva Contraseña(*)</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="password" id="nuevaContrasenaUsuario" name="nuevaContrasenaUsuario" placeholder="Ingrese una clave entre 4 y 8 digitos">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="contrasenaRepetidaUsuario"><strong>Repetir Nueva Contraseña (*) </strong></label>
                        <div class="col-sm-6">
                            <input class="form-control" type="password" id="contrasenaRepetidaUsuario" name="contrasenaRepetidaUsuario" placeholder="Repita su Clave">
                        </div>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <div class="col-sm-offset-2 col-sm-9">
                            <a onclick="ActualizarClave()" class="btn btn-warning"><i class="icon icon-next"> </i> Actualizar Contraseña</a>
                        </div>
                    </div>

                    <input type="hidden" id="accion" name="accion" value="ACTUALIZAR_CLAVE">
                    <input type="hidden" class="form-control" id="runCambioClave" name="runCambioClave" type="text" value="<?php echo $run; ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        rellenarFormulario();
    });

    function rellenarFormulario() {
        var runEditar = document.getElementById('runEditar').value;
        var url_json = '../Servlet/administrarUsuario.php';
        $.ajax({
            type: "POST",
            url: url_json,
            data: 'accion=BUSCAR_BY_ID&run=' + runEditar,
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

    function ActualizarClave() {
        if (validarClaves()) {
            $.ajax({
                type: "POST",
                url: "../Servlet/administrarUsuario.php",
                data: $("#fmContraseña").serialize(),
                success: function (result) {
                    console.log(result);
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        notificacion(result.errorMsg, 'danger', 'alert2');
                    } else {
                        notificacion(result.mensaje, 'success', 'alert2');
                        // document.location = "administrarUsuarios.php";
                    }
                }
            });
        }
    }

    function guardarUsuario() {
        document.getElementById('accion').value = "ACTUALIZAR";
        if (validarMiPerfil()) {
            $.ajax({
                type: "POST",
                url: "../Servlet/administrarUsuario.php",
                data: $("#fmusuario").serialize(),
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        notificacion(result.errorMsg, 'danger', 'alert');
                    } else {
                        notificacion(result.mensaje, 'success', 'alert');
                        // document.location = "administrarUsuarios.php";
                    }
                }
            });
        }
    }




</script>

<?php include("footer.php"); ?>