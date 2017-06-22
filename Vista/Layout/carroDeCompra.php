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

<form enctype="multipart/form-data" method="post" action="">
    <div class="cart-info">
        <table>
            <thead>
                <tr>
                    <td class="image">Imagen</td>
                    <td class="name">Nombre Producto</td>
                    <td class="model">Descripción</td>
                    <td class="quantity">Cantidad</td>
                    <td class="price">Precio Unitario</td>
                    <td class="total">Total</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="image"><a href="#"><img title="Bag Lady" alt="Bag Lady" src="../../Files/img/Productos/miniatura_images.jpg" width="60px" height="60px"></a></td>
                    <td class="name"><a href="#">Bag Lady</a></td>
                    <td class="model">Product 8</td>
                    <td class="quantity"><input type="text" size="1" value="1" name="" class="w30">
                        &nbsp;
                        <input type="image" title="Update" alt="Update" src="../../Files/img/update.png">
                        &nbsp;<a href="#"><img title="Remove" alt="Remove" src="../../Files/img/remove.png"></a></td>
                    <td class="price">$131.25</td>
                    <td class="total">$131.25</td>
                </tr>
                <tr>
                    <td class="image"><a href="#"><img title="Bag Lady" alt="Bag Lady" src="../../Files/img/Productos/miniatura_images.jpg" width="60px" height="60px"></a></td>
                    <td class="name"><a href="#">MacBook Pro</a><br>
                        <small>Reward Points: 100</small></td>
                    <td class="model">Product 10</td>
                    <td class="quantity"><input type="text" size="1" value="1" name="" class="w30">
                        &nbsp;
                        <input type="image" title="Update" alt="Update" src="../../Files/img/update.png">
                        &nbsp;<a href="#"><img title="Remove" alt="Remove" src="../../Files/img/remove.png"></a></td>
                    <td class="price">$181.00</td>
                    <td class="total">$181.00</td>
                </tr>
                <tr>
                    <td class="image"><a href="#"><img title="Bag Lady" alt="Chair Swing" src="../../Files/img/Productos/miniatura_images.jpg" width="60px" height="60px"></a></td>
                    <td class="name"><a href="#">Chair Swing</a></td>
                    <td class="model">Product 3</td>
                    <td class="quantity"><input type="text" size="1" value="1" name="" class="w30">
                        &nbsp;
                        <input type="image" title="Update" alt="Update" src="../../Files/img/update.png">
                        &nbsp;<a href="#"><img title="Remove" alt="Remove" src="../../Files/img/remove.png"></a></td>
                    <td class="price">$140.50</td>
                    <td class="total">$140.50</td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

<div class="cart-total">
    <table id="total">
        <tbody>
            <tr>
                <td class="right"><b>Sub-Total:</b></td>
                <td class="right">$510.99</td>
            </tr>
            <tr>
                <td class="right"><b>Total:</b></td>
                <td class="right">$608.41</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="buttons">
    <div>
        <a class="btn btn-warning btn-sm" style="float: right; color: #fff;" href="#">Pagar</a>    
        <a class="btn btn-warning btn-sm" style="float: left; color: #fff;" href="index.php">Continuar Comprando</a>
    </div>
</div>

<?php include("footer.php"); ?>