
<?php
include("header.php");
if (isset($_REQUEST['asunto']) && !empty($_REQUEST['asunto']) && isset($_REQUEST['mensaje']) && !empty($_REQUEST['mensaje'])) {
    $destino = $_REQUEST['destino'];
    $asunto = $_REQUEST['asunto'];
    $mensaje = $_REQUEST['mensaje'];
    $desde = "FROM:" . $_REQUEST['desde'];
    mail($destino, $asunto, $mensaje, $desde);
    echo 'Exito';
} else {
    echo 'Error';
}
include("footer.php"); 
?>
