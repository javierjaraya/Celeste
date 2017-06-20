<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $categorias = $control->getAllCategorias();
        $json = json_encode($categorias);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $nombreCategoria = htmlspecialchars($_REQUEST['nombreCategoria']);

        $object = $control->getCategoriaByNombre($nombreCategoria);
        if (($object->getIdCategoria() == null || $object->getIdCategoria() == "")) {
            $categoria = new CategoriaDTO();
            $categoria->setNombreCategoria($nombreCategoria);

            $result = $control->addCategoria($categoria);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Categoria ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'La categoria ya existe, intento con otro nombre.'));
        }
    } else if ($accion == "BORRAR") {
        $idCategoria = htmlspecialchars($_REQUEST['idCategoria']);

        $result = $control->removeCategoria($idCategoria);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Categoria borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $categorias = $control->getCategoriaLikeAtrr($cadena);
        $json = json_encode($categorias);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idCategoria = htmlspecialchars($_REQUEST['idCategoria']);

        $categoria = $control->getCategoriaByID($idCategoria);
        $json = json_encode($categoria);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idCategoria = htmlspecialchars($_REQUEST['idCategoria']);
        $nombreCategoria = htmlspecialchars($_REQUEST['nombreCategoria']);

        $categoria = new CategoriaDTO();
        $categoria->setIdCategoria($idCategoria);
        $categoria->setNombreCategoria($nombreCategoria);

        $result = $control->updateCategoria($categoria);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Categoria actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
