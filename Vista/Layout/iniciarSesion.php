<?php include("header.php"); ?>

<div class="12">
    <h4 style="padding: 1%; border: orangered 1px solid; border-radius: 15px; text-align: center;" class="TextoTituloFormulario"><strong>INGRESE SUS DATOS PARA INICIAR SESIÓN</strong></h4>
</div>

<div class="12" style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">      
    <div  class="row">
        <div id="alert"></div>    
        <form id="fmlogin" class="form-horizontal">
            <div id="fmlogin" class="form-group">
                <label for="inputRun" class="col-sm-2 control-label">Run</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputRun" name="inputRun" placeholder="112223337">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Contraseña">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <a>Olvido su contraseña</a>                                
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
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