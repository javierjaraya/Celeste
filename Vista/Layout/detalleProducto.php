<?php include("header.php");
$idSubCategoria = htmlspecialchars($_REQUEST['sub']);
$subcategoria = $control->getSubcategoriaByID($idSubCategoria);
?>

<div class="product-info">
        <div class="left">
          <div class="image"> <div id="wrap" style="top:0px;z-index:1000;position:relative;"><a href="image/product/iphone_1.jpg" title="iPhone" class="cloud-zoom colorbox cboxElement" id="zoom1" rel="adjustX: 0, adjustY:0, tint:'#000000',tintOpacity:0.2, zoomWidth:360, position:'inside', showTitle:false" style="position: relative; display: block;"> <img src="image/product/iphone_1_350x350.jpg" title="#" alt="#" id="image" style="display: block;"><span id="zoom-image"><i class="zoom_bttn"></i> Zoom</span></a><div class="mousetrap" style="background-image: url(&quot;.&quot;); z-index: 999; position: absolute; width: 350px; height: 350px; left: 0px; top: 0px; cursor: pointer;"></div></div> </div>
          <div class="image-additional"> <a href="image/product/iphone_1.jpg" title="#" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: 'image/product/iphone_1_350x350.jpg' "> <img src="image/product/iphone_1-62x62.jpg" width="62" title="#" alt="#"></a> <a href="image/product/htc_touch_hd_1.jpg" title="#" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: 'image/product/htc_touch_hd_1_350x350.jpg' "> <img src="image/product/htc_touch_hd_1_62x62.jpg" width="62" title="#" alt="#"></a> <a href="image/product/htc_touch_hd_11.jpg" title="#" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: 'image/product/htc_touch_hd_11_350x350.jpg' "> <img src="image/product/htc_touch_hd_11_62x62.jpg" width="62" title="#" alt="#"></a> <a href="image/product/iphone_2.jpg" title="#" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: 'image/product/iphone_2_350x350.jpg' "> <img src="image/product/iphone_2_62x62.jpg" width="62" title="#" alt="#"></a> </div>
        </div>
        <div class="right">
          <h1>iPhone</h1>
          <div class="description"> <span>Brand:</span> <a href="#">Apple</a><br>
            <span>Product Code:</span> product 11<br>
            <span>Availability:</span> In Stock</div>
          <div class="price">Price: <span class="price-old">$119.50</span>
            <div class="price-tag">$120.68</div>
            <br>
            <span class="price-tax">Ex Tax: $101.00</span><br>
          </div>
          <div class="cart">
            <div>
              <div class="qty"> <strong>Qty:</strong> <a href="javascript:void(0);" class="qtyBtn mines">-</a>
                <input type="text" value="1" size="2" name="quantity" class="w30" id="qty">
                <a href="javascript:void(0);" class="qtyBtn plus">+</a>
                <div class="clear"></div>
              </div>
              <input type="button" class="button" id="button-cart" value="Add to Cart">
            </div>
          </div>
          <div class="review">
            <div></div>
          </div>          
        </div>
      </div>






<?php include("footer.php"); ?>
