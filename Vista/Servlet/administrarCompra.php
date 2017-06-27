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

        $estado = "Procesando";
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
        $stock_disponible = true;
        $producto_sin_stock = array();
        $i_sin_stock = 0;
        if ($carro) {
            foreach ($carro as $producto) {
                $detalle_compra = new Detalle_compraDTO();
                $detalle_compra->setIdCompra($idCompra);
                $detalle_compra->setIdProducto($producto['id']);
                $detalle_compra->setPrecio($producto['precio']);
                $detalle_compra->setCantidad($producto['cantidad']);
                $cantidad_articulos++;
                $total_carro = $total_carro + ($producto['precio'] * $producto['cantidad']);


                /* descuento stock */
                $object = $control->getProductoByID($producto['id']);
                if ($object->getStock() >= $producto['cantidad']) {
                    $stock = $object->getStock() - $producto['cantidad'];
                    $object->setStock($stock);
                    $control->updateProducto($object);

                    $resultDetalle = $control->addDetalle_compra($detalle_compra);
                } else {
                    $stock_disponible = false;
                    $producto_sin_stock[$i_sin_stock] = array('producto' => $object, 'stockSolicitado' => $producto['cantidad']);
                    $i_sin_stock++;
                }
            }
        }

        if ($stock_disponible) {

            /* PAGAR EN PAYPAL */
            //$paypal_business = "manuel.gaete.v-facilitator@gmail.com";
            $paypal_business = "manuel.gaete.v@gmail.com";
            $paypal_currency = "USD";
            $paypal_cursymbol = "&$";
            $paypal_location = "CL";
            $paypal_returnurl = "http://localhost/Celeste/Vista/Layout/pagoRealizado.php?idCompra=" . $idCompra;
            $paypal_returntxt = "Pago Realizado Exitosamente!";
            $paypal_cancelurl = "http://localhost/Celeste/Vista/Layout/pagoCancelado.php?idCompra=" . $idCompra;

            /* Detalle compra */
            //$ppurl = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_cart";
            $ppurl = "https://www.paypal.com/cgi-bin/webscr?cmd=_cart";
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
                    $precioEnDolar = ($producto["precio"] / 661);
                    $ppurl.="&item_name_$i=" . urlencode($producto["nombre"]) . "&quantity_$i=" . $producto["cantidad"] . "&amount_$i=" . $precioEnDolar . "&item_number_$i=" . $i;
                    $i++;
                }
            }
            $ppurl.= "&tax_cart=0.00";

            if ($result) {
                echo json_encode(array(
                    'url' => $ppurl,
                    'success' => true,
                    'mensaje' => "Redireccionando a PayPal"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array(
                'productos' => $producto_sin_stock,
                'success' => false,
                'mensaje' => "Existen productos con bajo stock"
            ));
        }
    } else if ($accion == "BORRAR") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);

        $result = $control->removeCompra($idCompra);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Compra borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "CANCELAR") {
        $idCompra = htmlspecialchars($_REQUEST['idCompra']);

        $detalle_compras = $control->getAllDetalle_compraByIDCompra($idCompra);

        foreach ($detalle_compras as $detalle) {
            /* Obtener producto */
            $producto = $control->getProductoByID($detalle->getIdProducto());
            /* Sumar stock */
            $stock = $producto->getStock() + $detalle->getCantidad();
            /* Actualizar producto */
            $producto->setStock($stock);
            $control->updateProducto($producto);
        }

        $result = $control->removeCompra($idCompra);

        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Compra anulada correctamente"));
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
                'mensaje' => "Estado compra actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
