<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $detalle_compras = $control->getAllDetalle_compras();
        $json = json_encode($detalle_compras);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idDetalle = htmlspecialchars($_REQUEST['idDetalle']);
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);
        $precio = htmlspecialchars($_REQUEST['precio']);
        $cantidad = htmlspecialchars($_REQUEST['cantidad']);

        $object = $control->getDetalle_compraByID($idDetalle);
        if (($object->getIdDetalle() == null || $object->getIdDetalle() == "")) {
            $detalle_compra = new Detalle_compraDTO();
            $detalle_compra->setIdDetalle($idDetalle);
            $detalle_compra->setIdCompra($idCompra);
            $detalle_compra->setIdProducto($idProducto);
            $detalle_compra->setPrecio($precio);
            $detalle_compra->setCantidad($cantidad);

            $result = $control->addDetalle_compra($detalle_compra);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Detalle_compra ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la detalle_compra ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idDetalle = htmlspecialchars($_REQUEST['idDetalle']);

        $result = $control->removeDetalle_compra($idDetalle);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Detalle_compra borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $detalle_compras = $control->getDetalle_compraLikeAtrr($cadena);
        $json = json_encode($detalle_compras);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idDetalle = htmlspecialchars($_REQUEST['idDetalle']);

        $detalle_compra = $control->getDetalle_compraByID($idDetalle);
        $json = json_encode($detalle_compra);
        echo $json;
    } else if ($accion == "BUSCAR_All_BY_ID_COMPRA") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);

        $detalle_compra = $control->getAllDetalle_compraByIDCompra($idCompra);
        $json = json_encode($detalle_compra);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idDetalle = htmlspecialchars($_REQUEST['idDetalle']);
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);
        $precio = htmlspecialchars($_REQUEST['precio']);
        $cantidad = htmlspecialchars($_REQUEST['cantidad']);

        $detalle_compra = new Detalle_compraDTO();
        $detalle_compra->setIdDetalle($idDetalle);
        $detalle_compra->setIdCompra($idCompra);
        $detalle_compra->setIdProducto($idProducto);
        $detalle_compra->setPrecio($precio);
        $detalle_compra->setCantidad($cantidad);

        $result = $control->updateDetalle_compra($detalle_compra);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Detalle_compra actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
