<div id="column-left">
    <!--Categories Part Start-->
    <div class="box">
        <div class="box-heading"><span>Categorias</span></div>        
        <div class="box-content box-category">

            <!-- Contenedor cd-accordion-menu -->
            <ul id="accordion" class="accordion">
                <?php
                include_once '../../Controlador/Celeste.php';
                $control = Celeste::getInstancia();

                $categorias = $control->getAllCategorias();
                foreach ($categorias as $cat) {
                    $subcategorias = $control->getAllSubcategoriasByIdCategoria($cat->getIdCategoria());
                    if (count($subcategorias) > 0) {
                        echo "<li id='" . $cat->getIdCategoria() . "'>";
                        echo "<div class='link'><i class='fa fa-paint-brush'></i>" . $cat->getNombreCategoria() . "<i class='fa fa-chevron-down'></i></div>";
                        echo "<ul class='submenu'>";
                        foreach ($subcategorias as $sub) {
                            echo "<li><a rel='nofollow' rel='noreferrer' href='verProductos.php?cat=" . $cat->getIdCategoria() . "&sub=" . $sub->getIdSubCategoria() . "'>" . $sub->getNombreSubCategoria() . "</a></li>";
                        }
                        echo "</ul>";
                        echo "</li>";
                    }
                }
                ?>
            </ul>
            <!-- cd-accordion-menu -->

        </div>
    </div>
    <!--Categories Part End-->
    <!--Latest Product Start-->
    <div class="box">
        <div class="box-heading"><span>Últimos productos</span></div>
        <div class="box-content">
            <div class="box-product">

                <div>
                    <div class="image">
                        <a href="producto.php?producto=4">
                            <img src="../../Files/img/Productos/miniatura_images.jpg" alt="new">
                        </a>
                    </div>
                    <div class="producto.php?producto=4"><a href="producto.php">new </a></div>
                    <div class="price">$767.677.676 </div>
                </div>

            </div>
        </div>
    </div>
    <!--Latest Product End-->

    <div class="box">
        <div class="box-heading"><span>Más Vendidos</span></div>
        <div class="box-content">
            <div class="box-product">
                <div>
                    <div class="image">
                        <a href="producto.php?producto=4">
                            <img src="../../Files/img/Productos/miniatura_images.jpg" alt="new">
                        </a>
                    </div>
                    <div class="producto.php?producto=4"><a href="producto.php">new </a></div>
                    <div class="price">$767.677.676 </div>
                </div>


            </div>
        </div>
    </div>

    <!--Specials Product Start-->

    <!--Specials Product End-->
</div>

<script>
    $(function () {
        cat = getParameterByName("cat");
        console.log(cat);
        if (cat != "") {
            document.getElementById(cat).className = " default open";
        }
    });

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

</script>