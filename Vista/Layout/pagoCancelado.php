<?php include("header.php"); ?>

<?php
$idCompra = htmlspecialchars($_REQUEST['idCompra']);
?>

<div style="padding-bottom: 10px;">
    <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#">Compra Cancelada</a></div>
</div>
<input type="hidden" name="idCompra" id="idCompra" value="<?= $idCompra ?>">
<div id="alert"></div>
<div id="loader" style="margin-left: 400px;"></div>


<script>
    $(document).ready(function () {
        cancelarCompra();
    });

    function cancelarCompra() {
        var idCompra = document.getElementById("idCompra").value;
        var parametros = {"accion": "BORRAR", "idCompra": idCompra};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                notificacion("La compra se a cancelado", 'info', 'alert');
                setTimeout(function(){window.location = "carroDeCompra.php";},4000);  
            }
        });
    }

</script>
<?php include("footer.php"); ?>