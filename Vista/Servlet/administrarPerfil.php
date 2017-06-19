<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $perfils = $control->getAllPerfils();
        $json = json_encode($perfils);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);
        $nombrePerfil = htmlspecialchars($_REQUEST['nombrePerfil']);

        $object = $control->getPerfilByID($idPerfil);
        if (($object->getIdPerfil() == null || $object->getIdPerfil() == "")) {
            $perfil = new PerfilDTO();
            $perfil->setIdPerfil($idPerfil);
            $perfil->setNombrePerfil($nombrePerfil);

            $result = $control->addPerfil($perfil);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Perfil ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la perfil ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);

        $result = $control->removePerfil($idPerfil);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Perfil borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $perfils = $control->getPerfilLikeAtrr($cadena);
        $json = json_encode($perfils);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);

        $perfil = $control->getPerfilByID($idPerfil);
        $json = json_encode($perfil);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);
        $nombrePerfil = htmlspecialchars($_REQUEST['nombrePerfil']);

            $perfil = new PerfilDTO();
            $perfil->setIdPerfil($idPerfil);
            $perfil->setNombrePerfil($nombrePerfil);

        $result = $control->updatePerfil($perfil);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Perfil actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
