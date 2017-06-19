<?php include("header.php"); ?>

<!--Middle Part Start-->
<div id="content" style="">   

    <div>
        <div class="cajaFormulario" style=" padding: 3%; align-content: center;">
            <h2 class="TextoTituloFormulario" style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%"><strong>AGREGAR CATEGORIA DE PRODUCTOS</strong></h2><br><br>
            <div style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                <legend class="TextoTituloFormulario" ><strong>DATOS CATEGORIA</strong> </legend>  <a style="float: right">(*) Campos Obligatorios</a><br><br>
                <hr style="border: orangered 1px solid;"> <br><br>
                <div id="alert"></div>

                <form id="fmcategoria" method="post" >
                    <div class="divformulario">
                        <label class="TextoFormulario" for="nombreCategoria"><strong>Nombre Categoria (*)</strong></label>
                        <input class="inputFormulario" id="nombreCategoria" name="nombreCategoria" type="text" placeholder=""4><br><br>
                    </div>
                    <div style="text-align: center">                        
                        <a id="boton" onclick="crearCategora()" class="button" style="margin: 20px"><i class="icon-lock"> </i> Crear Categoria</a>
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
        }else{
            notificacion("Debe ingresar el nombre de la categoria", 'success', 'alert');
        }
    }
</script>

<!--Middle Part End-->
<?php include("footer.php"); ?>