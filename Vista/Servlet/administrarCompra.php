<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $compras = $control->getAllCompras();
        $json = json_encode($compras);
        echo $json;
    }if ($accion == "MI_LISTADO") {
        $run = htmlspecialchars($_REQUEST['run']);
        $compras = $control->miGetAllCompras($run);
        $json = json_encode($compras);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $metodoDespacho = htmlspecialchars($_REQUEST['metodoDespacho']);
        $direccionDespacho = htmlspecialchars($_REQUEST['direccionDespacho']);
        $personaRetira = htmlspecialchars($_REQUEST['personaRetira']);

        $estado = "Processando";
        session_start();
        $run = $_SESSION["run"];
        $idCompra = $control->getIdCompras();

        /* REGISTRAMOS LA COMRPA */
        $compra = new CompraDTO();
        $compra->setIdCompra($idCompra);
        $compra->setEstado($estado);
        $compra->setMetodoDespacho($metodoDespacho);
        $compra->setDireccionDespacho($direccionDespacho);
        $compra->setPersonaRetira($personaRetira);
        $compra->setRun($run);

        $result = $control->addCompra($compra);

        /* REGISTRAMOS LOS PRODUCTOS */
        $carritoCompra = $control->getCarritoCompra();
        $carro = $carritoCompra->get_content();
        $total_carro = 0;
        $cantidad_articulos = 0;
        if ($carro) {
            foreach ($carro as $producto) {
                $detalle_compra = new Detalle_compraDTO();
                $detalle_compra->setIdCompra($idCompra);
                $detalle_compra->setIdProducto($producto['id']);
                $detalle_compra->setPrecio($producto['precio']);
                $detalle_compra->setCantidad($producto['cantidad']);
                $cantidad_articulos++;
                $total_carro = $total_carro + ($producto['precio'] * $producto['cantidad']);
                $resultDetalle = $control->addDetalle_compra($detalle_compra);
            }
        }

        /* VACIAR CARRO DE COMPRA */

        /* PAGAR EN PAYPAL */
        $paypal_business = "manuel.gaete.v-facilitator@gmail.com";
        $paypal_currency = "CLP";
        $paypal_cursymbol = "&$";
        $paypal_location = "CL";
        $paypal_returnurl = "http://localhost/Celeste/Vista/Layout/pagoRealizado.php";
        $paypal_returntxt = "Pago Realizado Exitosamente!";
        $paypal_cancelurl = "http://localhost/Celeste/Vista/Layout/pagoRealizado.php";

        /* Detalle compra */
        $ppurl = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_cart";
        $ppurl .= "&business=" . $paypal_business;
        $ppurl .= "&no_note=1";
        $ppurl .= "&currency_code=" . $paypal_currency;
        $ppurl .= "&charset=utf-8&rm=1&upload=1";
        $ppurl .= "&business=" . $paypal_business;
        $ppurl .= "&return=" . urlencode($paypal_returnurl);
        $ppurl .= "&cancel_return=" . urlencode($paypal_cancelurl);
        $ppurl .= "&page_style=&paymentaction=sale&bn=katanapro_cart&invoice=KP-";

        $i = 1;
        if ($carro) {
            foreach ($carro as $producto) {
                $ppurl.="&item_name_$i=" . urlencode($producto["nombre"]) . "&quantity_$i=" . $producto["cantidad"] . "&amount_$i=" . $producto["precio"] . "&item_number_$i=" . $i;
                $i++;
            }
        }
        $ppurl.= "&tax_cart=0.00";
        
        /* Url paypal*/
        $url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick";
        $url .= "";



        if ($result) {
            echo json_encode(array(
                'url' => $ppurl,
                'success' => true,
                'mensaje' => "Compra ingresada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BORRAR") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);

        $result = $control->removeCompra($idCompra);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Compra borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $compras = $control->getCompraLikeAtrr($cadena);
        $json = json_encode($compras);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);

        $compra = $control->getCompraByID($idCompra);
        $json = json_encode($compra);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);
        $fechaCompra = htmlspecialchars($_REQUEST['fechaCompra']);
        $estado = htmlspecialchars($_REQUEST['estado']);
        $metodoDespacho = htmlspecialchars($_REQUEST['metodoDespacho']);
        $direccionDespacho = htmlspecialchars($_REQUEST['direccionDespacho']);
        $personaRetira = htmlspecialchars($_REQUEST['personaRetira']);
        $run = htmlspecialchars($_REQUEST['run']);

        $compra = new CompraDTO();
        $compra->setIdCompra($idCompra);
        $compra->setFechaCompra($fechaCompra);
        $compra->setEstado($estado);
        $compra->setMetodoDespacho($metodoDespacho);
        $compra->setDireccionDespacho($direccionDespacho);
        $compra->setPersonaRetira($personaRetira);
        $compra->setRun($run);

        $result = $control->updateCompra($compra);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Compra actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "ACTUALIZAR_ESTADO") {
        $estado = htmlspecialchars($_REQUEST['estado1']);
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);
        $compra = new CompraDTO();
        $compra->setIdCompra($idCompra);
        $compra->setEstado($estado);

        $result = $control->updateEstadoCompra($compra);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Estado compra actualizado correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
