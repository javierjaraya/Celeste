<?php include("header.php"); ?>

<?php
$idCompra = htmlspecialchars($_REQUEST['idCompra']);
?>

<div style="padding-bottom: 10px;">
    <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#">Compra Cancelada</a></div>
</div>
<div class="row">
    <div id="alert"></div>
</div>

<div id="loader" style="margin-left: 400px;"></div>
<input type="hidden" name="idCompra" id="idCompra" value="<?= $idCompra ?>">

<script>
    $(document).ready(function () {
        cancelarCompra();
    });

    function cancelarCompra() {
        var idCompra = document.getElementById("idCompra").value;
        var parametros = {"accion": "CANCELAR", "idCompra": idCompra};
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../Servlet/administrarCompra.php',
            data: parametros,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='../../Files/img/loader.gif'>");
            },
            success: function (data) {
                notificacion("La compra se ha cancelado", 'warning', 'alert');
                setTimeout(function(){window.location = "carroDeCompra.php";},3000);  
            }
        });
    }

</script>
<?php include("footer.php"); ?>