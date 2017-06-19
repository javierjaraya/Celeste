<?php

include_once '../../Controlador/Celeste.php';
$control = Celeste::getInstancia();

$run = $_POST['inputRun'];
$clave = $_POST['inputPassword'];
$success = true;
$mensajes;
$pagina = "";
if (($run != null || $run != "") && ($clave != null || $clave != "")) {
    $run = substr($run, 0, -1);
    $usuario = $control->getUsuarioByID($run);
    if ($usuario->getRun() == $run) {
        if ($usuario->getClave() == $clave) {
                session_start();
                //$nivel = $control->nivelFuncionariaRecienteByRun($run);
                $perfil = $control->getPerfilByID($usuario->getIdPerfil());

                $_SESSION["autentificado"] = "SI";
                $_SESSION["idPerfil"] = $perfil->getIdPerfil();
                $_SESSION["run"] = $usuario->getRun();

                $nombres = explode(" ", $usuario->getNombres());
                $apellidos = explode(" ", $usuario->getApellidos());
                $_SESSION["nombre"] = $nombres[0] . " " . $apellidos[0];
                $_SESSION["sexo"] = $usuario->getSexo();

                if ($perfil->getIdPerfil() == 1) {//Visitante
                    $pagina = "Vista/Layout/index.php";
                }
                if ($perfil->getIdPerfil() == 2) {//Usuario
                    $pagina = "Vista/Layout/index.php";
                }
                if ($perfil->getIdPerfil() == 3) {//Administrador
                    $pagina = "Vista/Layout/index.php";
                }
                $success = true;
                $mensajes = "Iniciando...";
        } else {
            $success = false;
            $mensajes = "La clave ingresada es incorrecta.";
        }
    } else {
        $success = false;
        $mensajes = "Usuario no existe.";
    }
} else {
    $success = false;
    $mensajes = "Ninguna casilla puede estar vacÍa.";
}
echo json_encode(array(
    'success' => $success,
    'mensaje' => $mensajes,
    'pagina' => $pagina
));
?>