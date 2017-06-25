<?php include("header.php"); ?>

<?php
$idCompra = htmlspecialchars($_REQUEST['idCompra']);
?>

<div style="padding-bottom: 10px;">
    <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#">Compra Realizada</a></div>
</div>

<div id="alert"></div>

<div style=" padding: 5px; color: #333; font-size: 15px; font-weight: bold; text-align: center; border-top: 1px solid #EEEEEE;border-left: 1px solid #EEEEEE;border-right: 1px solid #EEEEEE; width: 150px;">
    Detalle Compra
</div>

<div id="tab-description" class="review-list" style="display: block;">  
    <div id="alert"></div>
    <form id="fm" class="form-horizontal" method="post" style=" max-width: 820px;">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="metodoDespacho">Metodo Despacho:</label>
            <div class="col-sm-6">
                <div id="metodoDespacho">

                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="personaRetira">Nombre persona que retira:</label>
            <div class="col-sm-6">
                <div id="personaRetira">

                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="direccionDespacho">Direccion despacho:</label>
            <div class="col-sm-6">
                <div id="direccionDespacho">

                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="fechaEntrega">Fecha Envio:</label>
            <div class="col-sm-6">
                <div id="fechaEntrega">En envio se realizara a mas tardar dos dias habiles a partir de la fecha de compra </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="estadoCompra">Estado:</label>
            <div class="col-sm-6">
                <div id="estadoCompra"></div>
            </div>
        </div>
        <input type="hidden" id="idCompra" name="idCompra" value="<?= $idCompra ?>">
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

<script>
    $(document).ready(function () {
        notificacion("Su compra se a realizado exitosamente.", 'success', 'alert');
        cambiarEstadoCompra();
    });

    function cambiarEstadoCompra() {
        var idCompra = document.getElementById("idCompra").value;
        var parametros = {"accion": "ACTUALIZAR_ESTADO", "estado1": "En Origen", "idCompra": idCompra};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                cargarCompra(idCompra);
                cargarCarro();
            }
        });
    }

    function cargarCompra(idCompra) {
        var parametros = {"accion": "BUSCAR_BY_ID", "idCompra": idCompra};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                var data = eval('(' + data + ')');

                $("#metodoDespacho").html(data.metodoDespacho);
                $("#personaRetira").html(data.personaRetira);
                $("#direccionDespacho").html(data.direccionDespacho);
                $("#estadoCompra").html(data.estado);
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
                confirmarVaciarCarro();
            }
        });
    }
    function confirmarVaciarCarro() {
        var parametros = {"accion": "VACIAR_CARRO"};        
        $.ajax({
            url: '../Servlet/administrarCarroCompra.php',
            data: parametros,
            success: function (data) {
                var data = eval('(' + data + ')');
                $("#cart-total").html("$ 0");
            }
        });
    }

</script>



<?php include("footer.php"); ?>