<?php
include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "ENVIAR_CORREO") {
        if (isset($_REQUEST['asunto']) && !empty($_REQUEST['asunto']) && isset($_REQUEST['mensaje']) && !empty($_REQUEST['mensaje'])) {
            $destino = $_REQUEST['destino'];
            $asunto = $_REQUEST['asunto'];
            $mensaje = $_REQUEST['mensaje'].". Enviado por: ".$_REQUEST['desde']; ;
            $desde = "FROM:" . $_REQUEST['desde'];
            mail($destino, $asunto, $mensaje, $desde);
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Operación exitosa"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
?>