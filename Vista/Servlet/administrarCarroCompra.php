<?php

include_once '../../Controlador/Celeste.php';

$control = Celeste::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "AGREGAR_ARTICULO") {

        session_start();
        if (!isset($_SESSION["autentificado"])) {
            echo json_encode(array('success' => false, 'url' => 'iniciarSesion.php'));
        } else {
            $idProducto = htmlspecialchars($_REQUEST['idProducto']);
            $cantidad = htmlspecialchars($_REQUEST['cantidad']);

            $producto = $control->getProductoByID($idProducto);
            $imagen = $producto->getImagen();
            $idSubCategoria = $producto->getIdSubCategoria();
            $subCategoria = $control->getSubcategoriaByID($idSubCategoria);
            $idCategoria = $subCategoria->getIdCategoria();

            $carritoCompra = $control->getCarritoCompra();
            $cantidad_en_carro = $carritoCompra->getCantidad_By_IdProducto($idProducto) + $cantidad;

            if ($producto->getStock() >= $cantidad_en_carro) {
                //array que crea un producto
                $articulo = array(
                    "cat" => $idCategoria,
                    "sub" => $idSubCategoria,
                    "id" => $idProducto,
                    "stock" => $producto->getStock(),
                    "cantidad" => $cantidad,
                    "precio" => $producto->getPrecio(),
                    "imagen" => $imagen->getRutaImagen(),
                    "nombre" => "" . $producto->getNombreProducto() . ""
                );

                //añadir el producto
                $carritoCompra->add($articulo);
                $precio_total = $carritoCompra->precio_total();

                echo json_encode(array(
                    'success' => true,
                    'stock' => true,
                    'precio_total' => $precio_total,
                    'cantidad' => $cantidad_en_carro,
                    'mensaje' => "Producto agregado correctamente"
                ));
            } else {
                echo json_encode(array(
                    'success' => true,
                    'stock' => false,
                    'stock_disponible' => $producto->getStock(),
                    'stock_solicitado' => $cantidad_en_carro,
                    'mensaje' => "Producto agregado correctamente"
                ));
            }
        }
    } else if ($accion == "BORRAR_ARRICULO") {
        session_start();
        $idProducto = htmlspecialchars($_REQUEST['idProducto']);
        $unique_id = md5($idProducto);

        $carritoCompra = $control->getCarritoCompra();
        $resutl = $carritoCompra->remove_producto($unique_id);

        if ($resutl) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Producto borrado correctamente del carro."
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'mensaje' => "No se pudo eliminar el producto del carro."
            ));
        }
    } else if ($accion == "ACTUALIZAR_ARRICULO") {
        session_start();
        if (!isset($_SESSION["autentificado"])) {
            echo json_encode(array('success' => false, 'url' => 'iniciarSesion.php'));
        } else {
            $idProducto = htmlspecialchars($_REQUEST['idProducto']);
            $cantidad = htmlspecialchars($_REQUEST['cantidad']);

            $producto = $control->getProductoByID($idProducto);
            $imagen = $producto->getImagen();
            $idSubCategoria = $producto->getIdSubCategoria();
            $subCategoria = $control->getSubcategoriaByID($idSubCategoria);
            $idCategoria = $subCategoria->getIdCategoria();

            $carritoCompra = $control->getCarritoCompra();
            $cantidad_en_carro = $carritoCompra->getCantidad_By_IdProducto($idProducto);

            if ($producto->getStock() >= $cantidad) {
                $unique_id = md5($idProducto);
                $resutl = $carritoCompra->remove_producto($unique_id);

                //array que crea un producto
                $articulo = array(
                    "cat" => $idCategoria,
                    "sub" => $idSubCategoria,
                    "id" => $idProducto,
                    "stock" => $producto->getStock(),
                    "cantidad" => $cantidad,
                    "precio" => $producto->getPrecio(),
                    "imagen" => $imagen->getRutaImagen(),
                    "nombre" => "" . $producto->getNombreProducto() . ""
                );

                //añadir el producto
                $carritoCompra->add($articulo);
                $precio_total = $carritoCompra->precio_total();

                echo json_encode(array(
                    'success' => true,
                    'stock' => true,
                    'precio_total' => $precio_total,
                    'cantidad' => $cantidad,
                    'mensaje' => "Producto actualizado correctamente"
                ));
            } else {
                echo json_encode(array(
                    'success' => true,
                    'stock' => false,
                    'stock_disponible' => $producto->getStock(),
                    'stock_solicitado' => $cantidad_en_carro,
                    'mensaje' => "No hay stock disponible."
                ));
            }
        }
    } else if ($accion == "OBTENER_TOTAL_CARRO") {
        session_start();

        $carritoCompra = $control->getCarritoCompra();
        $precio_total = $carritoCompra->precio_total();

        echo json_encode(array(
            'precio_total' => $precio_total
        ));
    } else if ($accion == "OBTENER_CARRO") {
        session_start();
        $carritoCompra = $control->getCarritoCompra();

        //asignamos a $carro el método get_content() que contiene el contenido del carrito
        $carro = $carritoCompra->get_content();
        $carro_html = "";
        $total_carro = 0;
        if ($carro) {
            foreach ($carro as $producto) {
                $cantidad = $producto['cantidad'];
                $precio = number_format($producto['precio'], 0, ',', '.');
                $total = number_format($producto['precio'] * $producto['cantidad'], 0, ',', '.');
                $total_carro += ($producto['precio'] * $producto['cantidad']);
                $carro_html = $carro_html . "<tr>"
                        . "    <td class='image'><a href='detalleProducto.php?cat=" . $producto['cat'] . "&sub=" . $producto['sub'] . "&idProducto=" . $producto['id'] . "'><img title='Bag Lady' alt='Bag Lady' src='../../" . $producto['imagen'] . "' width='60px' height='60px'></a></td>"
                        . "    <td class='name'><a href='detalleProducto.php?cat=" . $producto['cat'] . "&sub=" . $producto['sub'] . "&idProducto=" . $producto['id'] . "'>" . $producto['nombre'] . "</a></td>"
                        . "    <td class='quantity'><input type='number' size='1' min='1' max='" . $producto['stock'] . "' value='" . $producto['cantidad'] . "' id='cant" . $producto['id'] . "' class='w60'>"
                        . "        &nbsp;"
                        . "        <a href='#' onclick='actualizarProducto(" . $producto['id'] . ")'><img title='Update' alt='Update' src='../../Files/img/update.png'></a>"
                        . "        <a href='#' onclick='borrarProducto(" . $producto['id'] . ")'><img title='Remove' alt='Remove' src='../../Files/img/remove.png'></a></td>"
                        . "    <td class='price'>$" . $precio . "</td>"
                        . "    <td class='total'>$" . $total . "</td>"
                        . "</tr>";
            }
        }

        echo json_encode(array(
            'carro_html' => $carro_html,
            'total_carro' => number_format($total_carro, 0, ',', '.')
        ));
    } else if ($accion == "OBTENER_CARRO_CONFIRMACION") {
        session_start();
        $carritoCompra = $control->getCarritoCompra();

        //asignamos a $carro el método get_content() que contiene el contenido del carrito
        $carro = $carritoCompra->get_content();
        $carro_html = "";
        $total_carro = 0;
        if ($carro) {
            foreach ($carro as $producto) {
                $cantidad = $producto['cantidad'];
                $precio = number_format($producto['precio'], 0, ',', '.');
                $total = number_format($producto['precio'] * $producto['cantidad'], 0, ',', '.');
                $total_carro += ($producto['precio'] * $producto['cantidad']);
                $carro_html = $carro_html . "<tr>"
                        . "    <td class='image'><img title='Bag Lady' alt='Bag Lady' src='../../" . $producto['imagen'] . "' width='60px' height='60px'></td>"
                        . "    <td class='name'>" . $producto['nombre'] . "</td>"
                        . "    <td class='quantity'>" . $producto['cantidad'] . "</td>"
                        . "    <td class='total'>$" . $total . "</td>"
                        . "</tr>";
            }
        }

        echo json_encode(array(
            'carro_html' => $carro_html,
            'total_carro' => number_format($total_carro, 0, ',', '.')
        ));
    } else if ($accion == "VACIAR_CARRO") {
        session_start();

        $carritoCompra = $control->getCarritoCompra();
        $resutl = $carritoCompra->destroy();

        if ($resutl) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "El carro fue vaciado correctamente."
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'mensaje' => "Ocurrio un error al vaciar el carro."
            ));
        }
    }
}

