<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $usuarios = $control->getAllUsuarios();
        $json = json_encode($usuarios);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $run = htmlspecialchars($_REQUEST['runUsuario']);
        $nombres = htmlspecialchars($_REQUEST['nombresUsuario']);
        $apellidos = htmlspecialchars($_REQUEST['apellidosUsuario']);
        $correoElectronico = htmlspecialchars($_REQUEST['emailUsuario']);
        $telefono = htmlspecialchars($_REQUEST['telefonoUsuario']);
        $sexo = htmlspecialchars($_REQUEST['sexo']);
        $direccion = htmlspecialchars($_REQUEST['direccionUsuario']);
        $clave = htmlspecialchars($_REQUEST['contrasenaUsuario']);
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);
        $object = $control->getUsuarioByID($run);
        if (($object->getRun() == null || $object->getRun() == "")) {
            $usuario = new UsuarioDTO();
            $usuario->setRun($run);
            $usuario->setNombres($nombres);
            $usuario->setApellidos($apellidos);
            $usuario->setCorreoElectronico($correoElectronico);
            $usuario->setTelefono($telefono);
            $usuario->setSexo($sexo);
            $usuario->setDireccion($direccion);
            $usuario->setClave($clave);
            $usuario->setIdPerfil($idPerfil);

            $result = $control->addUsuario($usuario);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Felicidades, ya te encuentras registrado en nuestra página"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El usuario ya existe.'));
        }
    } else if ($accion == "BORRAR") {
        $run = htmlspecialchars($_REQUEST['run']);

        $result = $control->removeUsuario($run);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Usuario borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $usuarios = $control->getUsuarioLikeAtrr($cadena);
        $json = json_encode($usuarios);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $run = htmlspecialchars($_REQUEST['run']);

        $usuario = $control->getUsuarioByID($run);
        $json = json_encode($usuario);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $run = htmlspecialchars($_REQUEST['run']);
        $nombres = htmlspecialchars($_REQUEST['nombres']);
        $apellidos = htmlspecialchars($_REQUEST['apellidos']);
        $correoElectronico = htmlspecialchars($_REQUEST['correoElectronico']);
        $telefono = htmlspecialchars($_REQUEST['telefono']);
        $sexo = htmlspecialchars($_REQUEST['sexo']);
        $direccion = htmlspecialchars($_REQUEST['direccion']);
        $clave = htmlspecialchars($_REQUEST['clave']);
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);

            $usuario = new UsuarioDTO();
            $usuario->setRun($run);
            $usuario->setNombres($nombres);
            $usuario->setApellidos($apellidos);
            $usuario->setCorreoElectronico($correoElectronico);
            $usuario->setTelefono($telefono);
            $usuario->setSexo($sexo);
            $usuario->setDireccion($direccion);
            $usuario->setClave($clave);
            $usuario->setIdPerfil($idPerfil);

        $result = $control->updateUsuario($usuario);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Usuario actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
