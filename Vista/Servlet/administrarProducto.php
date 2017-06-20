<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $productos = $control->getAllProductos();
        $json = json_encode($productos);
        echo $json;
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

        $result = $control->removeProducto($idProducto);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Producto borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $productos = $control->getProductoLikeAtrr($cadena);
        $json = json_encode($productos);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);

        $producto = $control->getProductoByID($idProducto);
        $json = json_encode($producto);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);
        $nombreProducto = htmlspecialchars($_REQUEST['nombreProducto']);
        $descripcionProducto = htmlspecialchars($_REQUEST['descripcionProducto']);
        $stock = htmlspecialchars($_REQUEST['stock']);
        $precio = htmlspecialchars($_REQUEST['precio']);
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);

        $producto = new ProductoDTO();
        $producto->setIdProducto($idProducto);
        $producto->setNombreProducto($nombreProducto);
        $producto->setDescripcionProducto($descripcionProducto);
        $producto->setStock($stock);
        $producto->setPrecio($precio);
        $producto->setIdSubCategoria($idSubCategoria);

        $result = $control->updateProducto($producto);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Producto actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
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
