<?php
include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $productos = $control->getAllProductos();
        $json = json_encode($productos);
        echo $json;
    } else if ($accion == "LISTADO_BY_ID_SUBCATEGORIA") {
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);
        $productos = $control->getAllProductosBy_idSubCategoria($idSubCategoria);
        $json = json_encode($productos);
        echo $json;
    } else if ($accion == "LISTADO_BY_ID_SUBCATEGORIA_PAGINACION") {
        include '../../Util/Paginacion.php'; //incluir el archivo de paginación
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);
        $idCategoria = htmlspecialchars($_REQUEST['idCategoria']);
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? htmlspecialchars($_REQUEST['page']) : 1;
        $per_page = htmlspecialchars($_REQUEST['por_pagina']); //Cantidad de registros por pagina
        $order = htmlspecialchars($_REQUEST['orden']);

        session_start();
        $idPerfil = 3;
        if(isset($_SESSION["idPerfil"])){
            $idPerfil = $_SESSION["idPerfil"];
        }

        if ($order == "Defecto") {
            $order = "";
        } else if ($order == "A-Z") {
            $order = " ORDER BY producto.nombreProducto ASC";
        } else if ($order == "Z-A") {
            $order = " ORDER BY producto.nombreProducto DESC ";
        } else if ($order == "Menor-Mayor") {
            $order = " ORDER BY producto.precio ASC ";
        } else if ($order == "Mayor-Menor") {
            $order = " ORDER BY producto.precio DESC ";
        }

        $adjacents = 4; //brecha entre páginas después de varios adyacentes
        $offset = ($page - 1) * $per_page;

        $todos_los_productos = $control->getAllProductosBy_idSubCategoria($idSubCategoria);

        $numrows = count($todos_los_productos); //Cantidad total de tuplas
        $total_paginas = ceil($numrows / $per_page);
        $reload = 'verProductos.php';

        $productos = $control->getAllProductos_Limit_By_idSubCategoria($offset, $per_page, $order, $idSubCategoria);

        if ($numrows > 0) {
            ?>
            <div class="row" style="min-height: 350px; padding-left: 20px; padding-bottom: 20px; padding-right: 20px; "> 
                <?php
                foreach ($productos as $value) {
                    //echo json_encode($value);
                    if ($idPerfil != 1) {
                        echo "<div class='product-cuadro'>"
                        . "<div class='imagen'><a href='detalleProducto.php?cat=" . $idCategoria . "&sub=" . $idSubCategoria . "&idProducto=" . $value->getIdProducto() . "'><img src='../../" . $value->getImagen()->getRutaImagen() . "' width='135px' height='135px' alt='iPhone'></a></div>"
                        . "<div class='nombre'><a href='detalleProducto.php?cat=" . $idCategoria . "&sub=" . $idSubCategoria . "&idProducto=" . $value->getIdProducto() . "'>" . $value->getNombreProducto() . "</a></div>"
                        . "<div class='precio'>$" . number_format($value->getPrecio(), 0, ',', '.') . "</div>"
                        . "<div class='cart'>"
                        . "  <input type='button' value='Agregar al Carro' onclick='agregarAlCarro(" . $value->getIdProducto() . ");' class='button'>"
                        . "</div>"
                        . "</div>";
                    } else {
                        echo "<div class='product-cuadro'>"
                        . "<div class='imagen'><a href='detalleProducto.php?cat=" . $idCategoria . "&sub=" . $idSubCategoria . "&idProducto=" . $value->getIdProducto() . "'><img src='../../" . $value->getImagen()->getRutaImagen() . "' width='135px' height='135px' alt='iPhone'></a></div>"
                        . "<div class='nombre'><a href='detalleProducto.php?cat=" . $idCategoria . "&sub=" . $idSubCategoria . "&idProducto=" . $value->getIdProducto() . "'>" . $value->getNombreProducto() . "</a></div>"
                        . "<div class='precio'>$" . number_format($value->getPrecio(), 0, ',', '.') . "</div>"
                        . "<div class='cart'>"
                        . "</div>"
                        . "</div>";
                    }
                }
                ?>
            </div>
            <div class="table-pagination " style="text-align: center; height: 60px;">
                <?php echo paginate($reload, $page, $total_paginas, $adjacents); ?>
            </div>

            <?php
        } else {
            ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
            <?php
        }
    } else if ($accion == "AGREGAR") {
        $nombreProducto = htmlspecialchars($_REQUEST['nombreProducto']);
        $descripcionProducto = htmlspecialchars($_REQUEST['descripcionProducto']);
        $stock = htmlspecialchars($_REQUEST['stock']);
        $precio = htmlspecialchars($_REQUEST['precio']);
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);
        $imagen = $_FILES['imagen'];

        $object = $control->getProductoByNombre($nombreProducto);
        if (($object->getIdProducto() == null || $object->getIdProducto() == "")) {
            include_once("../../Util/SubirImagen.php");

            $result;
            $resultImagen;
            $idProducto = $control->getIdProducoDisponible();
            $producto = new ProductoDTO();
            $producto->setIdProducto($idProducto);
            $producto->setNombreProducto($nombreProducto);
            $producto->setDescripcionProducto($descripcionProducto);
            $producto->setStock($stock);
            $producto->setPrecio($precio);
            $producto->setIdSubCategoria($idSubCategoria);

            if (validarTamaños($imagen, 10000000) == true) {
                $result = $control->addProducto($producto);

                $subirImagen = new SubirImagen("../../Files/img/Productos/");
                $fecha = date("Y") . date("m") . date("d") . date("H") . date("i") . date("s");
                $nombreImagen = $subirImagen->asignaNombre($imagen['type'], "producto_" . $fecha);
                $subirImagen->setName("producto_" . $fecha);
                $subirImagen->setMaximoSize(10000000); //10mb
                //Subir imagen al servidor
                $respuesta = $subirImagen->subirImagen($imagen);

                if ($respuesta == true) {

                    $imagenProducto = new ImagenDTO();
                    $imagenProducto->setNombreImagen($nombreImagen);
                    $imagenProducto->setRutaImagen("Files/img/Productos/" . $nombreImagen);
                    $imagenProducto->setIdProducto($idProducto);

                    //registrar imagen a la BD
                    $resultImagen = $control->addImagen($imagenProducto); //Registramos la imagen en la BD
                }
            }

            if ($result) {
                if ($resultImagen) {
                    echo json_encode(array(
                        'success' => true,
                        'mensaje' => "Producto ingresada correctamente"
                    ));
                } else {
                    echo json_encode(array('errorMsg' => 'Ha ocurrido un error al subir la imagen'));
                }
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error al registrar el producto.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la producto ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);

        $detalle_compras = $control->getAllDetalle_compraByIDProducto($idProducto);

        if (count($detalle_compras) == 0) {
            $imagen = $control->getImagenByIdProducto($idProducto);
            $result = $control->removeProducto($idProducto);

            if ($result) {
                unlink("../../Files/img/Productos/" . $imagen->getNombreImagen());
                echo json_encode(array('success' => true, 'mensaje' => "Producto borrado correctamente"));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El producto está asociado a una venta, no se puede eliminar.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);

        $productos = $control->getProductoLikeAtrr($cadena);

        $lista_productos = array();
        foreach ($productos as $p) {
            array_push($lista_productos, array("id" => $p->getIdProducto(), "label" => $p->getNombreProducto()));
        }

        $json = json_encode($lista_productos);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);

        $producto = $control->getProductoByID($idProducto);
        $json = json_encode($producto);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $imagenRemplazada = htmlspecialchars($_REQUEST['imagenRemplazada']);
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);
        $nombreProducto = htmlspecialchars($_REQUEST['nombreProducto']);
        $descripcionProducto = htmlspecialchars($_REQUEST['descripcionProducto']);
        $stock = htmlspecialchars($_REQUEST['stock']);
        $precio = htmlspecialchars($_REQUEST['precio']);
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);
        $idImagen = htmlspecialchars($_REQUEST['idImagen']);
        $imagen = $_FILES['imagen'];

        $producto = new ProductoDTO();
        $producto->setIdProducto($idProducto);
        $producto->setNombreProducto($nombreProducto);
        $producto->setDescripcionProducto($descripcionProducto);
        $producto->setStock($stock);
        $producto->setPrecio($precio);
        $producto->setIdSubCategoria($idSubCategoria);

        $result = $control->updateProducto($producto);

        if ($imagenRemplazada == "TRUE") {
            include_once("../../Util/SubirImagen.php");

            if (validarTamaños($imagen, 10000000) == true) {

                $subirImagen = new SubirImagen("../../Files/img/Productos/");
                $fecha = date("Y") . date("m") . date("d") . date("H") . date("i") . date("s");
                $nombreImagen = $subirImagen->asignaNombre($imagen['type'], "producto_" . $fecha);
                $subirImagen->setName("producto_" . $fecha);
                $subirImagen->setMaximoSize(10000000); //10mb
                //Subir imagen al servidor
                $respuesta = $subirImagen->subirImagen($imagen);

                if ($respuesta == true) {

                    $imagenProducto = new ImagenDTO();
                    $imagenProducto->setNombreImagen($nombreImagen);
                    $imagenProducto->setRutaImagen("Files/img/Productos/" . $nombreImagen);
                    $imagenProducto->setIdProducto($idProducto);

                    //registrar imagen a la BD
                    $imagenAnterior = $control->getImagenByID($idImagen);
                    unlink("../../Files/img/Productos/" . $imagenAnterior->getNombreImagen());
                    $control->removeImagen($idImagen);
                    $resultImagen = $control->addImagen($imagenProducto); //Registramos la imagen en la BD
                }
            }
        }

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Producto actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "OBTENER_N_PRODUCTOS_RECIENTES") {
        $cantidad = htmlspecialchars($_REQUEST['cantidad']);
        $productos = $control->getProducto_n_recientes($cantidad);
        $json = json_encode($productos);
    } else if ($accion == "OBTENER_N_PRODUCTOS_MAS_VENDIDOS") {
        $cantidad = htmlspecialchars($_REQUEST['cantidad']);
        $productos = $control->getProducto_n_mas_vendidos($cantidad);
        $json = json_encode($productos);
    } else if ($accion == "OBTENER_N_PRODUCTOS_MAS_VENDIDOS_ENTRE_FECHAS") {
        $cantidad = htmlspecialchars($_REQUEST['cantidad']);
        $fecha_desde = htmlspecialchars($_REQUEST['fecha_desde']);
        $fecha_hasta = htmlspecialchars($_REQUEST['fecha_hasta']);

        $productos = $control->getProducto_n_mas_vendidos_by_fechas($cantidad, $fecha_desde, $fecha_hasta);

        $label = array();
        $cantida = array();

        foreach ($productos as $value) {
            array_push($label, $value->getNombreProducto());
            array_push($cantida, $value->getCantidad());
        }

        echo json_encode(array(
            'count' => count($label),
            'labels' => $label,
            'data' => $cantida
        ));
    }
}

function validarTamaños($imagenes, $tamañoMaximo) {
    $validar = true;
    if ($imagenes["name"][0]) {
        for ($i = 0; $i < count($imagenes["name"]); $i++) {
            if ($imagenes["size"][$i] <= $tamañoMaximo) {
                //Imagen con tamaño permitido
            } else {
                $validar = false;
            }
        }
    } else {
        $validar = false;
    }
    return $validar;
}
