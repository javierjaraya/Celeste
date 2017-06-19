<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $imagens = $control->getAllImagens();
        $json = json_encode($imagens);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idImagen = htmlspecialchars($_REQUEST['idImagen']);
        $nombreImagen = htmlspecialchars($_REQUEST['nombreImagen']);
        $rutaImagen = htmlspecialchars($_REQUEST['rutaImagen']);
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);

        $object = $control->getImagenByID($idImagen);
        if (($object->getIdImagen() == null || $object->getIdImagen() == "")) {
            $imagen = new ImagenDTO();
            $imagen->setIdImagen($idImagen);
            $imagen->setNombreImagen($nombreImagen);
            $imagen->setRutaImagen($rutaImagen);
            $imagen->setIdProducto($idProducto);

            $result = $control->addImagen($imagen);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Imagen ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la imagen ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idImagen = htmlspecialchars($_REQUEST['idImagen']);

        $result = $control->removeImagen($idImagen);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Imagen borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $imagens = $control->getImagenLikeAtrr($cadena);
        $json = json_encode($imagens);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idImagen = htmlspecialchars($_REQUEST['idImagen']);

        $imagen = $control->getImagenByID($idImagen);
        $json = json_encode($imagen);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idImagen = htmlspecialchars($_REQUEST['idImagen']);
        $nombreImagen = htmlspecialchars($_REQUEST['nombreImagen']);
        $rutaImagen = htmlspecialchars($_REQUEST['rutaImagen']);
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($idImagen);
            $imagen->setNombreImagen($nombreImagen);
            $imagen->setRutaImagen($rutaImagen);
            $imagen->setIdProducto($idProducto);

        $result = $control->updateImagen($imagen);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Imagen actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
