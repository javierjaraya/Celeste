<?php include("header.php"); ?>

<!--Middle Part Start-->
<div id="content" style="">   
    <!--    <div   style="background: red ; margin: 5%; margin-left: 0%">-->

    <h4 style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%" class="TextoTituloFormulario"><strong>INGRESE SUS DATOS PARA INICIAR SESIÓN</strong></h4><br>
    <div style="  padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
        <div id="alert"></div>
        <form id="fmlogin" class="form-horizontal" method="post">
            <div class="form-group-sm">
                <label class="col-sm-2 control-label TextoFormulario" for="inputRun"><strong>Run</strong></label>
                <div class="col-sm-10">
                    <input class="form-control" id="inputRun" name="inputRun" type="text" placeholder="112223337"><br><br>
                </div>
            </div>
            <div class="form-group-sm">
                <label class="col-sm-2 control-label TextoFormulario" for="inputPassword"><strong>Contraseña</strong></label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="inputPassword" name="inputPassword" placeholder="Contraseña"><br><br>
                </div>
            </div>
            <div class="form-group-sm">
                <a href="#" class=""><small>Olvido su contraseña</small></a>
                <a id="boton" onclick="validarLogin()" class="button "> </i> Iniciar Sesión</a>
            </div>
        </form>
    </div>

    <!--    </div>-->
    <script>
        function validarLogin() {
            $.ajax({
                type: "POST",
                url: "../Servlet/login.php",
                data: $("#fmlogin").serialize(),
                success: function (result) {
                    console.log(result);
                    var result = eval('(' + result + ')');
                    if (!result.success) {
                        notificacion(result.mensaje, 'danger', 'alert');
                    } else {
                        location.href = result.pagina;
                    }
                }
            });
        }
    </script>

</div>
<!--Middle Part End-->
<?php include("footer.php"); ?>