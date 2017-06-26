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

</style>

<div style="padding-bottom: 10px;">
    <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#">Carro Compra</a></div>
</div>

<div id="alert"></div>

<div style=" padding: 5px; color: #333; font-size: 15px; font-weight: bold; text-align: center; border-top: 1px solid #EEEEEE;border-left: 1px solid #EEEEEE;border-right: 1px solid #EEEEEE; width: 150px;">
    Datos Despacho
</div>

<div id="tab-description" class="review-list" style="display: block;">  
    <div id="alert"></div>
    <form id="fm" class="form-horizontal" method="post" style=" max-width: 820px;">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="medotoDespacho">Metodo Despacho:</label>
            <div class="col-sm-6">
                <select class="form-control" id="metodoDespacho" name="metodoDespacho">
                    <option value="Retiro en tienda">Retiro en tienda</option>
                    <option value="Despacho a domicilio">Despacho a domicilio</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="personaRetira">Nombre persona que retira:</label>
            <div class="col-sm-6">
                <input class="form-control" id="personaRetira" name="personaRetira" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="direccionDespacho">Direccion despacho:</label>
            <div class="col-sm-6">
                <input class="form-control" id="direccionDespacho" name="direccionDespacho" type="text">                                     
            </div>
        </div>
    </form>
</div>


<form enctype="multipart/form-data" method="post" action="">
    <div class="cart-info">
        <table>
            <thead>
                <tr>
                    <td class="image">Imagen</td>
                    <td class="name">Nombre Producto</td>
                    <td class="quantity">Cantidad</td>
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
            <a class="btn btn-default btn-sm" style="float: right;" href="#"><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Confirmar y pagar</a>
        <?php } else { ?>
            <a class="btn btn-primary btn-sm" style="float: right; color: #fff;" onclick="confirmarYpagar()"><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Confirmar y pagar</a>
        <?php } ?>        
    </div>
</div>


<!-- DIALOGO MODAL-->
<div class="modal fade bs-example-modal-md" id="dg-modela" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <section id="panel-modal">
                <div class="modal-header" style=" border: orangered 1px solid; border-radius: 15px; text-align: center ; margin:  1%;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="logo-modal" src="../../Files/img/log.png" width="60px" style="float: left;">
                    <label class="titulo-modal" style="width: 300px; padding-top: 20px;"><h4 class="modal-title" id="modalLabel">Productos con stock bajo</h4></label>
                </div>
                <form id="fm" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div style="margin: 1%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                        <div class="modal-body">
                            <section class="row"> 
                                <div id="alert-modal"></div>
                                <section class="col-md-12">
                                    <div class="cart-info">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td class="image">Imagen</td>
                                                    <td class="name">Nombre Producto</td>
                                                    <td class="quantity">Stock Solicitado</td>
                                                    <td class="total">Stock Disponible</td>
                                                </tr>
                                            </thead>
                                            <tbody id="contenido-bajo-stock">

                                            </tbody>
                                        </table>
                                    </div>
                                </section>                           
                            </section><!-- Fin Row-->
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-warning" data-dismiss="modal">Aceptar</a>
                        </div>   
                    </div>             
                </form>
            </section>
        </div>
    </div>
</div><!-- END DIALOGO MODAL-->


<script>
    $(document).ready(function () {
        cargarUsuario();
        cargarCarro();
    });

    function cargarUsuario() {
        var parametros = {"accion": "OBTENER_USUARIO_SESION"};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarUsuario.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                var data = eval('(' + data + ')');
                document.getElementById("personaRetira").value = data.nombres + " " + data.apellidos;
                document.getElementById("direccionDespacho").value = data.direccion;
            }
        });
    }

    function cargarCarro() {
        var parametros = {"accion": "OBTENER_CARRO_CONFIRMACION"};
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
                $("#cart-total").html("$" + data.total_carro);
            }
        });
    }

    function confirmarYpagar() {
        if (validar()) {
            var metodoDespacho = document.getElementById('metodoDespacho').value;
            var direccionDespacho = document.getElementById('direccionDespacho').value;
            var personaRetira = document.getElementById('personaRetira').value;
            var parametros = {"accion": "AGREGAR", "metodoDespacho": metodoDespacho, "direccionDespacho": direccionDespacho, "personaRetira": personaRetira};
            $("#loader").fadeIn('slow');
            $.ajax({
                url: '../Servlet/administrarCompra.php',
                data: parametros,
                beforeSend: function (objeto) {
                    $("#loader").html("<img src='../../Files/img/loader.gif'>");
                }, success: function (data) {
                    var data = eval('(' + data + ')');
                    if (data.success == true) {
                        $("#loader").html("");
                        location.href = data.url;
                        notificacion(data.mensaje, 'success', 'alert');
                        //location.href = data.url;
                    } else {
                        if (data.errorMsg) {
                            notificacion(data.errorMsg, 'warning', 'alert');
                        } else {
                            notificacion(data.mensaje, 'warning', 'alert-modal');
                            productosBajoStock(data);
                            $('#dg-modela').modal(this)//CALL MODAL MENSAJE                            
                        }

                    }
                }
            });
        }
    }

    function productosBajoStock(data) {
        $("#contenido-bajo-stock").html("");        
        $.each(data.productos, function (k, v) {
            var html = "<tr>"
                    + "    <td class='image'><img title='Bag Lady' alt='Bag Lady' src='../../" + v.producto.imagen.rutaImagen + "' width='60px' height='60px'></td>"
                    + "    <td class='name'>" + v.producto.nombreProducto + "</td>"
                    + "    <td class='quantity' style='color: red;'><b>" + v.stockSolicitado + "</b></td>"
                    + "    <td class='quantity'><b>" + v.producto.stock + "</b></td>"
                    + "</tr>";
            $("#contenido-bajo-stock").append(html);
        });
    }

    function validar() {
        if (document.getElementById('personaRetira').value != "") {
            if (document.getElementById('direccionDespacho').value != "") {
                return true;
            } else {
                notificacion("Dbe ingresar la direccion de despacho", "warning", "alert");
            }
        } else {
            notificacion("Debe ingresar el nombre de la persona que retira", "warning", "alert");
        }
        return false;
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