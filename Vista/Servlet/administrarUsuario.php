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
            $usuario->setClave(md5($clave));
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
        $misCompras = $control->miGetAllCompras($run);
        if (count($misCompras) == 0) {
            $result = $control->removeUsuario($run);
            if ($result) {
                echo json_encode(array('success' => true, 'mensaje' => "Usuario borrado correctamente"));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        }else{
            echo json_encode(array('errorMsg' => 'El usuario no puede ser eliminado, ya que tiene ventas asociadas'));
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
        $run = htmlspecialchars($_REQUEST['runUsuario']);
        $nombres = htmlspecialchars($_REQUEST['nombresUsuario']);
        $apellidos = htmlspecialchars($_REQUEST['apellidosUsuario']);
        $correoElectronico = htmlspecialchars($_REQUEST['emailUsuario']);
        $telefono = htmlspecialchars($_REQUEST['telefonoUsuario']);
        $sexo = htmlspecialchars($_REQUEST['sexo']);
        $direccion = htmlspecialchars($_REQUEST['direccionUsuario']);

        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);
//        $clave = htmlspecialchars($_REQUEST['clave']);

        $usuario = new UsuarioDTO();
        $usuario->setRun($run);
        $usuario->setNombres($nombres);
        $usuario->setApellidos($apellidos);
        $usuario->setCorreoElectronico($correoElectronico);
        $usuario->setTelefono($telefono);
        $usuario->setSexo($sexo);
        $usuario->setDireccion($direccion);
//            $usuario->setClave(md5($clave));
        $usuario->setIdPerfil($idPerfil);

        $result = $control->updateUsuario($usuario);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Usuario actualizado correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "ACTUALIZAR_CLAVE") {
        $run = htmlspecialchars($_REQUEST['runCambioClave']);
        $clave = htmlspecialchars($_REQUEST['contrasenaUsuario']);
        $nuevaClave = htmlspecialchars($_REQUEST['nuevaContrasenaUsuario']);
        $object = $control->getUsuarioByID($run);
        $ClaveEncriptada = $object->getClave();

        $usuario = new UsuarioDTO();
        if ($ClaveEncriptada == md5($clave)) {
            $usuario->setRun($run);
            $usuario->setClave(md5($nuevaClave));
            $result = $control->updateClaveUsuario($usuario);
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Clave Actualizada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'La Clave actual es Incorrecta'));
        }
    } else if ($accion == "RECUPERAR_CLAVE") {
        $runIngresado = htmlspecialchars($_REQUEST['run']);
        $correoIngresado = htmlspecialchars($_REQUEST['correo']);
        $asunto = "Recuperar Clave";
        $desde = "FROM: Sistema Web Celeste";
        $destino = "joseline.cisternas@gmail.com";
        if (($runIngresado != null || $runIngresado != "") && ($correoIngresado != null || $correoIngresado != "")) {
            $usuario = $control->getUsuarioByID($runIngresado);
            $CorreoRegistrado = $usuario->getCorreoElectronico();
            $runRegistrado = $usuario->getRun();
            if (($runIngresado == $runRegistrado) && ($correoIngresado == $CorreoRegistrado)) {
                $nombreCompleto = $usuario->getNombres() . " " . $usuario->getApellidos();
                $ClaveAleatoria = rand(1000, 99999999);
                $mensaje = "Estimado/a " . $nombreCompleto . ", Su nueva clave secreta es: " . $ClaveAleatoria . " . Le recomendamos cambiarla lo antes posible en la seccion 'Mi Perfil'";
                $usuarioModificado = new UsuarioDTO();
                $usuarioModificado->setRun($runRegistrado);
                $usuarioModificado->setClave(md5($ClaveAleatoria));
                $result = $control->updateClaveUsuario($usuarioModificado);
                if ($result) {
                    mail($destino, $asunto, $mensaje, $desde);
                    echo json_encode(array(
                        'success' => true,
                        'mensaje' => "Su nueva clave a sido enviada a su correo electronico"
                    ));
                } else {
                    echo json_encode(array('errorMsg' => 'Ha ocurrido un error al intentar actualizar la clave.'));
                }
            } else {
                echo json_encode(array('errorMsg' => 'Los datos ingresados no corresponden a un usuario válido'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'Debe ingresar datos validos'));
        }
    } else if ($accion == "OBTENER_USUARIO_SESION") {
        session_start();
        $run = $_SESSION['run'];
        $usuario = $control->getUsuarioByID($run);
        $json = json_encode($usuario);
        echo $json;
    }
}
