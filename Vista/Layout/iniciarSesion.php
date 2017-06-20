<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center;  margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>INGRESE SUS DATOS PARA INICIAR SESIÓN</strong></h4>
</div>

<div class="col-md-12" style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">      
    <div  class="row">
        <div id="alert"></div>    
        <form id="fmlogin" class="form-horizontal">
            <div id="fmlogin" class="form-group">
                <label for="inputRun" class="col-sm-4 control-label">Run</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputRun" name="inputRun" placeholder="112223337">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-4 control-label">Contraseña</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Contraseña">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <div class="checkbox">
                        <label style="width: 200px;">
                            <a>Olvido su contraseña</a>                                
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <a onclick="validarLogin()" class="btn btn-warning">Ingresar</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>





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

<!--Middle Part End-->
<?php include("footer.php"); ?>