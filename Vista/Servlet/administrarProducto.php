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
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);
        $nombreProducto = htmlspecialchars($_REQUEST['nombreProducto']);
        $descripcionProducto = htmlspecialchars($_REQUEST['descripcionProducto']);
        $stock = htmlspecialchars($_REQUEST['stock']);
        $precio = htmlspecialchars($_REQUEST['precio']);
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);

        $object = $control->getProductoByID($idProducto);
        if (($object->getIdProducto() == null || $object->getIdProducto() == "")) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($idProducto);
            $producto->setNombreProducto($nombreProducto);
            $producto->setDescripcionProducto($descripcionProducto);
            $producto->setStock($stock);
            $producto->setPrecio($precio);
            $producto->setIdSubCategoria($idSubCategoria);

            $result = $control->addProducto($producto);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Producto ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
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
