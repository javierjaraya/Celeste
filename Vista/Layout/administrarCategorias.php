<?php include("header.php"); ?>



    <div style="position: absolute;">
        <div class="contenedor" style=" padding: 3%; align-content: center; position: absolute; width: 780px;">
            <h2 class="TextoTituloFormulario" style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%"><strong>ADMINISTRAR CATEGORIAS DE PRODUCTOS</strong></h2><br><br>
            <div id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; position: absolute; width: 780px;">
                <legend class="TextoTituloFormulario" ><strong>CATEGORIAS</strong> </legend><br>
                <hr style="border: orangered 1px solid;"> <br>
                <div id="alert"></div>
                <a href="crearCategoria.php" class="button" style="margin: 10px"><i class="icon-lock"> </i> Agregar Categoria</a>                
                <div class="">
                    <table id="tabla" class="table" style="padding: 0px; float: bottom;">
                        <thead> 
                            <tr> 
                                <th>ID</th> 
                                <th>Nombre</th>
                                <th>Accion</th>
                            </tr> 
                        </thead>
                        <tbody id="tablaCategorias">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function () {
        cargarCategorias();
    });
    function cargarCategorias() {
        $("#tablaCategorias").empty();
        var url_json = '../Servlet/administrarCategoria.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    //console.log(datos);
                    $.each(datos, function (k, v) {
                        var contenido = "<tr>";
                        contenido += "<td>" + v.idCategoria + "</td>";
                        contenido += "<td>" + v.nombreCategoria + "</td>";
                        contenido += "<td>";
                        contenido += "<a class='button'  onclick='editar(" + v.idCategoria + ")'>Editar</button>";
                        contenido += "<a class='button'  onclick='borrar(" + v.idCategoria + ")'>Borrar</a>";
                        contenido += "<a class='button'  onclick='borrar(" + v.idCategoria + ")'>Agregar SubCategoria</a>";
                        contenido += "</td>";
                        contenido += "</tr>";
                        $("#tablaCategorias").append(contenido);
                    });
                    $('#tabla').DataTable();
                    //var width = document.getElementById("contenedor").css.offsetWidth;
                    //console.log(width);
                }
        );
    }

</script>
<!--Middle Part End-->
<?php include("footer.php"); ?>