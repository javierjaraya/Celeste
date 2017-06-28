<?php
ob_start(); //Iniciar Buffer
include_once '../../Controlador/Celeste.php';
$control = Celeste::getInstancia();
session_start();

if (isset($_SESSION["autentificado"])) {
    if ($_SESSION["autentificado"] == "SI") {
        $idPerfil = $_SESSION["idPerfil"];
        $nombre = $_SESSION["nombre"];
        $run = $_SESSION["run"];
        $autentificado = "SI";
    } else {
        header("Location: ../../index.php");
    }
}

$idCompra = htmlspecialchars($_REQUEST['idCompra']);

$datosCompra = $control->getCompraByID($idCompra);
$detalleCompra = $control->getAllDetalle_compraByIDCompra($idCompra);
?>

<html>
    <head>
        <style type="text/css">
            body{
                font-family:Arial, sans-serif;
                font-size: 11px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                line-height: 11px;   
            }
            .center{
                text-align: center;
            }

            .left{
                text-align: left;
            }

            .right{
                text-align: right;
            }

            .table {
                width: 733.22px;
                border-spacing:0;
                border-collapse:collapse;
                border-color:black;
            }
            .td-borde{
                border: black 1px solid;
            }

            .table td {
                font-size:14px;
                border-style:solid;
                border-width:1px;
                overflow:hidden;
                word-break:normal;
                border-color:black;
                color: black;
            }
            .table th {
                font-size:11px;
                height: 40px;
            }
            .fondo{
                background-color: #e68900;
            }
             .fondoClaro{
                background-color: #f7cc8f;
            }

            .alto-xs{
                height: 15.11px;
            }
            .alto-xm{
                height: 18.89px;
            }
            .alto-xl{
                height: 26.45px;
            }
            .alto-ms{
                height: 37.79px;
            }
            .alto-ms12{
                height: 45.35px;
            }
            .alto-ms17{
                height: 64.25px;
            }
            .alto-mm{
                height: 79.37px;
            }
            /*ALTURAS*/
            .ancho-10mm{
                width: 37.79px;
            }
            .ancho-11mm{
                width: 41.57px;
            }
            .ancho-12mm{
                width: 45.35px;
            }
            .ancho-13mm{
                width: 49.13px;
            }
            .ancho-14mm{
                width: 52.91px;
            }
            .ancho-15mm{
                width: 56.69px;
            }
            .ancho-16mm{
                width: 60.47px;
            }
            .ancho-17mm{
                width: 64.25px;
            }
            .ancho-18mm{
                width: 68.03px;
            }
            .ancho-19mm{
                width: 71.81px;
            }
            .ancho-23mm{
                width: 86.92px;
            }
            .ancho-30mm{
                width: 113.38px;
            }
            .ancho-32mm{
                width: 120.94px;
            }
            .ancho-34mm{
                width: 128.50px;
            }
            .ancho-43mm{
                width: 162.51px;
            }
            .ancho-46mm{
                width: 173.85px;
            }
            .ancho-56mm{
                width: 211.65px;
            }
            .ancho-62mm{
                width: 234.33px;
            }
            .ancho-69mm{
                width: 260.78px;
            }
            .ancho-71mm{
                width: 268.34px;
            }
            .ancho-80mm{
                width: 302.36px;
            }
            .ancho-84mm{
                width: 317.48px;
            }
            .ancho-94mm{
                width: 355.27px;
            }
            .ancho-100mm{
                width: 377.95px;
            }
            .ancho-117mm{
                width: 442.20px;
            }
            .ancho-129mm{
                width: 487.55px;
            }
            .ancho-132mm{
                width: 498.89px;
            }
            .ancho-137mm{
                width: 517.79px;
            }

        </style>
    </head>

    <body>
        <img src="../../Files/img/log.png" width="100" height="100" alt="log"/>
        <div>            
            <table class="table" >                    
                <tr><th class="td-borde fondo alto-xs" align="center"><h3> DETALLE COMPRA N&deg; <?= " " . $idCompra ?></h3></th></tr>
            </table>
        </div>  

        <br>
        <table class="table">
            <tr><td class="td-borde fondoClaro alto-xs" colspan="4" style = "text-align: left">Fecha Compra:</td><td class="td-borde ancho-100mm left"><?= " " . $datosCompra->getFechaCompra() ?></td></tr>
            <tr><td class="td-borde fondoClaro alto-xs" colspan="4" style = "text-align: left">Metodo de Despacho:</td><td class="td-borde ancho-100mm left"><?= " " . $datosCompra->getMetodoDespacho() ?></td></tr>
            <tr><td class="td-borde fondoClaro alto-xs" colspan="4" style = "text-align: left">Direcci&oacute;n de Despacho:</td><td class="td-borde ancho-100mm left"><?= " " . $datosCompra->getDireccionDespacho() ?></td></tr>
            <tr><td class="td-borde fondoClaro alto-xs" colspan="4" style = "text-align: left">Persona que Retira:</td><td class="td-borde ancho-100mm left"><?= " " . $datosCompra->getPersonaRetira() ?></td></tr>
            <tr><td class="td-borde fondoClaro alto-xs" colspan="4" style = "text-align: left">Estado:</td><td class="td-borde ancho-100mm left"><?= " " . $datosCompra->getEstado() ?></td></tr>
        </table>
        <div>
            <br>
            <table class="table">
                <tr><td class="td-borde alto-xm ancho-71mm" colspan="4">Detalle de la compra: </td></tr>                
                <tr><td class="td-borde fondo ancho-20mm" align="center" valign="top">Id Compra</td><td class="td-borde fondo ancho-30mm" align="center" valign="top">Cantidad</td><td class="td-borde fondo ancho-25mm" align="center" valign="top">Precio Unit.</td><td class="td-borde fondo ancho-20mm" align="center" valign="top">Subtotal</td></tr>
                <?php
                $count = 0;
                $Subtotal = 0;
                $montoTotalCompra = $control->getMontoTotalCompra($idCompra);
                foreach ($detalleCompra as $detalle) {
                    $Subtotal = $detalle->getCantidad() * $detalle->getPrecio();
                    echo '<tr><td class="td-borde alto-xs right" style = "text-align: center">' . $idCompra . '</td><td class="td-borde alto-xs" style = "text-align: center">' . $detalle->getCantidad() . '</td><td class="td-borde alto-xs" style = "text-align: center"> $ ' . $detalle->getPrecio() . '</td><td class="td-borde alto-xs center" style = "text-align: center"> $ ' . $Subtotal . '</td></tr>';
                    $count++;
                }
                ?>

            </table>
            <br>
            <table class="table">
                <tr><td class="td-borde fondo alto-xs" colspan="4" style = "text-align: right"><strong>Total Compra:</strong></td><td class="td-borde ancho-69mm center"><?= "$ " . $montoTotalCompra ?></td></tr>
            </table>
        </div>
    </body>
</html>
<?php
$html = ob_get_clean();
$html = utf8_encode($html);

define('MPDF_PATH', "../../Files/Complementos/mpdf60/");
include(MPDF_PATH . "mpdf.php");
$mpdf = new mPDF('UTF-8', array(216, 276));
$mpdf->allow_charset_conversion = true;
$mpdf->charset_in = 'UTF-8';
$mpdf->WriteHTML($html);
$mpdf->Output('Reporte de ventas diarias.pdf', 'I');

exit();
?>



