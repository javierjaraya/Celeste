<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>CATEGORIA</strong></h4>
</div>

<div class="col-md-12" id="subContenedor" style="height: 250px; margin-bottom: 20px; padding: 5px; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 5px;">
    <div class="col-md-8">
        <h5><strong>CATEGORIAS</strong></h5>
    </div>
    <div class="col-md-4">
        <a style="float: right">(*) Campos Obligatorios</a><br>
    </div>
    <div class="col-md-12">
        <hr style="border: orangered 1px solid;">
    </div>
    <div id="alert"></div>
    <br><br><br><br><br><br>
    <form id="fmcategoria" class="form-horizontal">
        <div class="form-group">            
            <label  class="col-sm-4 control-label" for="nombreCategoria">Nombre Categoria (*)</label>
            <div class="col-sm-6">
                <input class="form-control" id="nombreCategoria" name="nombreCategoria" type="text" placeholder="">
            </div>
        </div>
        <div class="form-group">  
            <div class="col-sm-offset-4 col-sm-6">
                <a id="boton" onclick="crearCategora()" class="btn btn-warning" style="margin: 20px">Crear Categoria</a>
            </div>

        </div>
        <input type="hidden" id="accion" name="accion" value="AGREGAR">
    </form>

</div>
</div>
</div>

</div>

<script type="text/javascript">

    function crearCategora() {
        if (document.getElementById('nombreCategoria').value != "") {
            $.ajax({
                type: "POST",
                url: "../Servlet/administrarCategoria.php",
                data: $("#fmcategoria").serialize(),
                success: function (result) {
                    console.log(result);
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        notificacion(result.errorMsg, 'danger', 'alert');
                    } else {
                        notificacion(result.mensaje, 'success', 'alert');
                        window.location = "administrarCategorias.php";
                    }
                }
            });
        } else {
            notificacion("Debe ingresar el nombre de la categoria", 'success', 'alert');
        }
    }
</script>

<!--Middle Part End-->
<?php include("footer.php"); ?>