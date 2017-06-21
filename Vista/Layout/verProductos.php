<?php include("header.php"); ?>

<?php
$idSubCategoria = htmlspecialchars($_REQUEST['sub']);
$subcategoria = $control->getSubcategoriaByID($idSubCategoria);
?>

<div class="row">
    <div class="col-xs-12">
        <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#"><?= $subcategoria->getNombreSubCategoria() ?></a></div>
        <div class="box">            
            <!--<div class="box-heading"><span>Featured</span></div>-->
            <h1> <?= $subcategoria->getNombreSubCategoria() ?> </h1>
            <div class="product-filter">
                <!--<div class="display"><b>Display</b></div>-->
                <div class="limit"><b>Ver:</b>
                    <select id="por_pagina" onchange="load(1)">
                        <option selected="selected" value="12">12</option>
                        <option value="24">24</option>
                        <option value="40">40</option>
                        <option value="80">80</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="sort"><b>Ordernar por:</b>
                    <select id="orden" onchange="load(1)">
                        <option selected="selected" value="Defecto">Defecto</option>
                        <option value="A-Z">Nombre (A - Z)</option>
                        <option value="Z-A">Nombre (Z - A)</option>
                        <option value="Menor-Mayor">Precio (Menor < Mayor)</option>
                        <option value="Mayor-Menor">Precio (Mayor > Menor)</option>
                    </select>
                </div>
            </div>

            <div id="loader" class="text-center"><img src="../../Files/img/loader.gif"></div>
            <div class="outer_div">
                <!-- Datos Productos aqui -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        load(1);
    });

    function load(page) {
        idSubCategoria = getParameterByName("sub");
        idCategoria = getParameterByName("cat");
        por_pagina = document.getElementById("por_pagina").value;
        orden = document.getElementById("orden").value;
        var parametros = {"accion": "LISTADO_BY_ID_SUBCATEGORIA_PAGINACION", "page": page, "por_pagina": por_pagina, "orden": orden, "idCategoria": idCategoria, "idSubCategoria": idSubCategoria};
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