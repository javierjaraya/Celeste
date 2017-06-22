<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $compras = $control->getAllCompras();
        $json = json_encode($compras);
        echo $json;
    }if ($accion == "MI_LISTADO") {
        $run = htmlspecialchars($_REQUEST['run']);
        $compras = $control->miGetAllCompras($run);
        $json = json_encode($compras);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);
        $fechaCompra = htmlspecialchars($_REQUEST['fechaCompra']);
        $estado = htmlspecialchars($_REQUEST['estado']);
        $metodoDespacho = htmlspecialchars($_REQUEST['metodoDespacho']);
        $direccionDespacho = htmlspecialchars($_REQUEST['direccionDespacho']);
        $personaRetira = htmlspecialchars($_REQUEST['personaRetira']);
        $run = htmlspecialchars($_REQUEST['run']);

        $object = $control->getCompraByID($idCompra);
        if (($object->getIdCompra() == null || $object->getIdCompra() == "")) {
            $compra = new CompraDTO();
            $compra->setIdCompra($idCompra);
            $compra->setFechaCompra($fechaCompra);
            $compra->setEstado($estado);
            $compra->setMetodoDespacho($metodoDespacho);
            $compra->setDireccionDespacho($direccionDespacho);
            $compra->setPersonaRetira($personaRetira);
            $compra->setRun($run);

            $result = $control->addCompra($compra);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Compra ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la compra ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);

        $result = $control->removeCompra($idCompra);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Compra borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $compras = $control->getCompraLikeAtrr($cadena);
        $json = json_encode($compras);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);

        $compra = $control->getCompraByID($idCompra);
        $json = json_encode($compra);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);
        $fechaCompra = htmlspecialchars($_REQUEST['fechaCompra']);
        $estado = htmlspecialchars($_REQUEST['estado']);
        $metodoDespacho = htmlspecialchars($_REQUEST['metodoDespacho']);
        $direccionDespacho = htmlspecialchars($_REQUEST['direccionDespacho']);
        $personaRetira = htmlspecialchars($_REQUEST['personaRetira']);
        $run = htmlspecialchars($_REQUEST['run']);

        $compra = new CompraDTO();
        $compra->setIdCompra($idCompra);
        $compra->setFechaCompra($fechaCompra);
        $compra->setEstado($estado);
        $compra->setMetodoDespacho($metodoDespacho);
        $compra->setDireccionDespacho($direccionDespacho);
        $compra->setPersonaRetira($personaRetira);
        $compra->setRun($run);

        $result = $control->updateCompra($compra);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Compra actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "ACTUALIZAR_ESTADO") {
        $estado = htmlspecialchars($_REQUEST['estado1']);
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);
        $compra = new CompraDTO();
        $compra->setIdCompra($idCompra);
        $compra->setEstado($estado);

        $result = $control->updateEstadoCompra($compra);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Estado compra actualizado correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
