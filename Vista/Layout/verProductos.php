<?php include("header.php"); ?>

<div class="row">
    <div class="col-xs-12">
        <h4> Listado de Productos </h4>
        <div id="loader" class="text-center"><img src="../../Files/img/loader.gif"></div>
        <div class="outer_div">
            <!-- Datos Productos aqui -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        load(1);
    });

    function load(page) {
        idSubCategoria = getParameterByName("sub");
        var parametros = {"accion": "LISTADO_BY_ID_SUBCATEGORIA_PAGINACION", "page": page, "idSubCategoria":idSubCategoria};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarProducto.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                console.log(data);
            
                $(".outer_div").html(data).fadeIn('slow');
                $("#loader").html("");
            }
        })
    }
</script>


<?php include("footer.php"); ?>