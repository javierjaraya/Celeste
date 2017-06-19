<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $subcategorias = $control->getAllSubcategorias();
        $json = json_encode($subcategorias);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);
        $nombreSubCategoria = htmlspecialchars($_REQUEST['nombreSubCategoria']);
        $idCategoria = htmlspecialchars($_REQUEST['idCategoria']);

        $object = $control->getSubcategoriaByID($idSubCategoria);
        if (($object->getIdSubCategoria() == null || $object->getIdSubCategoria() == "")) {
            $subcategoria = new SubcategoriaDTO();
            $subcategoria->setIdSubCategoria($idSubCategoria);
            $subcategoria->setNombreSubCategoria($nombreSubCategoria);
            $subcategoria->setIdCategoria($idCategoria);

            $result = $control->addSubcategoria($subcategoria);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Subcategoria ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la subcategoria ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);

        $result = $control->removeSubcategoria($idSubCategoria);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Subcategoria borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $subcategorias = $control->getSubcategoriaLikeAtrr($cadena);
        $json = json_encode($subcategorias);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);

        $subcategoria = $control->getSubcategoriaByID($idSubCategoria);
        $json = json_encode($subcategoria);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idSubCategoria = htmlspecialchars($_REQUEST['idSubCategoria']);
        $nombreSubCategoria = htmlspecialchars($_REQUEST['nombreSubCategoria']);
        $idCategoria = htmlspecialchars($_REQUEST['idCategoria']);

            $subcategoria = new SubcategoriaDTO();
            $subcategoria->setIdSubCategoria($idSubCategoria);
            $subcategoria->setNombreSubCategoria($nombreSubCategoria);
            $subcategoria->setIdCategoria($idCategoria);

        $result = $control->updateSubcategoria($subcategoria);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Subcategoria actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
