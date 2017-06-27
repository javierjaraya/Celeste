<?php include("header.php"); ?>

<style type="text/css">
    /*************** Cart ****************/
    .cart-info table { width: 100%; margin-bottom: 15px; border-collapse: collapse; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; }
    .cart-info td { padding: 7px; }
    .cart-info thead td { color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD; }
    .cart-info thead .image { text-align: center; }
    .cart-info thead .name, .cart-info thead .model, .cart-info thead .quantity { text-align: left; }
    .cart-info thead .price, .cart-info thead .total { text-align: right; }
    .cart-info tbody td { vertical-align: top; border-bottom: 1px solid #DDDDDD; }
    .cart-info tbody .image { text-align: center; }
    .cart-info tbody .name, .cart-info tbody .model, .cart-info tbody .quantity { text-align: left; }
    .cart-info tbody .quantity input[type='image'], .cart-info tbody .quantity img { position: relative; top: 4px; cursor: pointer; }
    .cart-info tbody .price, .cart-info tbody .total { text-align: right; }
    .cart-info tbody span.stock { color: #F00; font-weight: bold; }
    .cart-module > div { display: none; }
    .cart-total { border-top: 1px solid #DDDDDD; overflow: auto; padding-top: 8px; margin-bottom: 15px; }
    .cart-total table { float: right; }
    .cart-total td { padding: 3px; text-align: right; }
    .w30{width:30px!important; text-align:center;}

    .buttons {
        border-top: 1px solid #EEEEEE;
        overflow: auto;
        padding: 6px;
        margin-bottom: 20px;
        color: #fff;
    }


    input[type='number'], input[type='text'], input[type='password'], textarea {
        background: #F8F8F8;
        border: 1px solid #E4E4E4;
        padding: 7px;
        margin-left: 0px;
        margin-right: 0px;
        font-size: 14px;
    }

</style>

<div style="padding-bottom: 10px;">
    <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#">Carro Compra</a></div>
</div>

<div id="alert"></div>

<form enctype="multipart/form-data" method="post" action="">
    <div class="cart-info">
        <table>
            <thead>
                <tr>
                    <td class="image">Imagen</td>
                    <td class="name">Nombre Producto</td>
                    <!--<td class="model">Descripción</td>-->
                    <td class="quantity">Cantidad</td>
                    <td class="price">Precio Unitario</td>
                    <td class="total">Total</td>
                </tr>
            </thead>
            <tbody id="contenido-carro">

            </tbody>
        </table>
    </div>
</form>

<div class="cart-total">
    <table id="total">
        <tbody>
            <tr>
                <td class="right"><b>Total:</b></td>
                <td class="right" id="totalCarro">$ 0</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="buttons">
    <div>
        <?php if ($precio_total == 0) { ?>
            <a class="btn btn-default btn-sm" style="float: right;" href="#"><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Completar transacción</a>    
        <?php } else { ?>
            <a class="btn btn-primary btn-sm" style="float: right; color: #fff;" href="confirmarTransaccion.php"><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Completar transacción</a>
        <?php } ?>
        <a class="btn btn-danger btn-sm" style="float: right; color: #fff; margin-right: 10px;" href="#" onclick="vaciarCarro()"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Vaciar Carro</a>
        <a class="btn btn-warning btn-sm" style="float: left; color: #fff;" href="index.php"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Continuar Comprando</a>
    </div>
</div>

<!-- MODAL CONFIRMACION-->
<div class="modal fade bs-example-modal-sm" id="dg-confirmacion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-confirmacion" src="../../Files/img/log.png" width="60px" style="float: left;">
                    <label class="titulo-modal"><h4 class="modal-title" id="titulo-mensaje" style="padding-top: 20px;">Confirmación</h4></label>
                </div>
                <div class="modal-body">
                    <section class="row">
                        <section class="col-md-12">
                            <div id="contenedor-confirmacion">

                            </div>
                        </section>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmarVaciarCarro()"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Vaciar Carro</button>                    
                </div>
            </section>
        </div>
    </div>
</div><!-- END MODAL CONFIRMACION-->

<script>
    $(document).ready(function () {
        cargarCarro();
    });

    function cargarCarro() {
        var parametros = {"accion": "OBTENER_CARRO"};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCarroCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                var data = eval('(' + data + ')');
                $("#contenido-carro").html(data.carro_html);
                $("#totalCarro").html("$" + data.total_carro);
                $("#cart-total").html("Total Carro : $" + data.total_carro);
            }
        });
    }

    function agregarAlCarro(id) {
        var parametros = {"accion": "AGREGAR_ARTICULO", "idProducto": id, "cantidad": 1};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCarroCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                var data = eval('(' + data + ')');
                if (data.success == true) {
                    $("#loader").html("");
                    if (data.stock == true) {
                        $("#cart-total").html("Total Carro :  $" + number_format(data.precio_total, 0));
                        notificacion("Producto agregado correctamente. Total Carro: $" + number_format(data.precio_total, 0), 'success', 'alert');
                    } else {
                        notificacion("No hay mas stock disponible para este producto.", 'warning', 'alert');
                    }
                } else {
                    location.href = data.url;
                }
            }
        });
    }

    function borrarProducto(id) {
        var parametros = {"accion": "BORRAR_ARRICULO", "idProducto": id};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCarroCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                var data = eval('(' + data + ')');
                $("#loader").html("");
                if (data.success == true) {
                    notificacion(data.mensaje, 'success', 'alert');
                    cargarCarro()
                } else {
                    notificacion(data.mensaje, 'warning', 'alert');
                }
            }
        });
    }

    function actualizarProducto(id) {
        var cantidad = document.getElementById("cant" + id).value;
        var parametros = {"accion": "ACTUALIZAR_ARRICULO", "idProducto": id, "cantidad": cantidad};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCarroCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                console.log(data);
                var data = eval('(' + data + ')');
                $("#loader").html("");
                if (data.success == true) {
                    notificacion(data.mensaje, 'success', 'alert');
                    cargarCarro()
                } else {
                    notificacion(data.mensaje, 'warning', 'alert');
                }
            }
        });
    }

    function confirmacion(titulo, mensaje) {
        document.getElementById('logo-confirmacion').src = "../../Files/img/log.png";
        $('#titulo-confirmacion').html(titulo);
        $('#contenedor-confirmacion').html(mensaje);
        $('#dg-confirmacion').modal(this);//CALL MODAL MENSAJE
    }

    function vaciarCarro() {
        confirmacion('Confirmacion', '¿Esta seguro?, Una vez vaciado no se podran recuperar los datos.');
    }

    function confirmarVaciarCarro() {
        var parametros = {"accion": "VACIAR_CARRO"};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCarroCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                var data = eval('(' + data + ')');
                $("#loader").html("");
                $('#dg-confirmacion').modal('hide')
                if (data.success == true) {
                    notificacion(data.mensaje, 'success', 'alert');
                    cargarCarro();
                } else {
                    notificacion(data.mensaje, 'warning', 'alert');
                }
            }
        });
    }

    function number_format(amount, decimals) {
        amount += ''; // por si pasan un numero en vez de un string
        amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

        decimals = decimals || 0; // por si la variable no fue fue pasada

        // si no es un numero o es igual a cero retorno el mismo cero
        if (isNaN(amount) || amount === 0)
            return parseFloat(0).toFixed(decimals);

        // si es mayor o menor que cero retorno el valor formateado como numero
        amount = '' + amount.toFixed(decimals);

        var amount_parts = amount.split('.'),
                regexp = /(\d+)(\d{3})/;

        while (regexp.test(amount_parts[0]))
            amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

        return amount_parts.join('.');
    }

</script>

<?php include("footer.php"); ?>