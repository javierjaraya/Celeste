<?php include("header.php"); ?>

<!--Middle Part Start-->
<div id="content" style="padding-left: 2px">   
    <!--    <div   style="background: red ; margin: 5%; margin-left: 0%">-->
    <form id="fmlogin" method="post">
        <h2 style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%" class="TextoTituloFormulario"><strong>INGRESE SUS DATOS PARA INICIAR SESIÓN</strong></h2><br><br>
        <div style="  padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
        <div class="divformulario">
            <label class="TextoFormulario" for="inputRun"><strong>Run</strong></label>
            <input class="inputFormulario" id="inputRun" name="inputRun" type="text" placeholder="112223337"><br><br>
        </div>
        <div class="divformulario">
            <label class="TextoFormulario" for="inputPassword"><strong>Contraseña</strong></label>
            <input class="inputFormulario" type="password" id="inputPassword" name="inputPassword" placeholder="Contraseña"><br><br>
        </div>
        <div class="divformulario" style="text-align: center ;">
            <a id="boton" onclick="validarLogin()" class="button" style="margin: 20px"><i class="icon-lock"> </i> Iniciar Sesión</a>
            <a href="#" class="pull-right"><small>Olvido su contraseña</small></a>
        </div>
</div>
    </form>
    <!--    </div>-->
    <script>
        function validarLogin() {
            $('#fmlogin').form('submit', {
                url: "Vista/Servlet/login.php",
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    console.log(result);
                    var result = eval('(' + result + ')');
                    if (!result.success) {
                        $.messager.alert('Error', result.mensaje);
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