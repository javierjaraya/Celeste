<?php require_once('Connections/conec.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conec, $conec);
$query_ultimos = "SELECT * FROM tablaproducto WHERE tablaproducto.activo = 1 ORDER BY tablaproducto.idProducto desc limit 5";
$ultimos = mysql_query($query_ultimos, $conec) or die(mysql_error());
$row_ultimos = mysql_fetch_assoc($ultimos);
$totalRows_ultimos = mysql_num_rows($ultimos);

mysql_select_db($database_conec, $conec);
$query_categorias = "SELECT * FROM tablacategorias ORDER BY tablacategorias.nomCategoria asc";
$categorias = mysql_query($query_categorias, $conec) or die(mysql_error());
$row_categorias = mysql_fetch_assoc($categorias);
$totalRows_categorias = mysql_num_rows($categorias);


mysql_select_db($database_conec, $conec);
$query_ofertas = "SELECT * FROM tablaproducto WHERE tablaproducto.activo = 1 and tablaproducto.oferta = 1 ORDER BY tablaproducto.idProducto desc limit 5";
$ofertas = mysql_query($query_ofertas, $conec) or die(mysql_error());
$row_ofertas = mysql_fetch_assoc($ofertas);
$totalRows_ofertas = mysql_num_rows($ofertas);


?>
<style type="text/css">
body {
	background-color: #F0C;
}
</style>


<div id="column-left">
      <!--Categories Part Start-->
      <div class="box">
        <div class="box-heading">Categorias</div>
        <div class="box-content box-category">
          <ul id="custom_accordion">
            
            <?php do { ?>
            <li class="category57"><a class="nochild " href="categoria.php?categoria=<?php echo $row_categorias['idCategoria']; ?>"><?php echo $row_categorias['nomCategoria']; ?></a></li>
              <?php } while ($row_categorias = mysql_fetch_assoc($categorias)); ?>
            
            
          </ul>
        </div>
      </div>
      <!--Categories Part End-->
      <!--Latest Product Start-->
      <div class="box">
        <div class="box-heading">Últimos productos</div>
        <div class="box-content">
          <div class="box-product">
            
            
            
            
            <?php do {
				
				require_once('class.imgsizer.php');
		$imgSizer = new imgSizer();
		$imgSizer->type      = "width";
	$imgSizer->max       = 50;
	$imgSizer->quality   = 8;
	$imgSizer->square    = true;
	$imgSizer->prefix    = "miniatura_";
	$imgSizer->folder    = "_min50/";
	// Single image ##################################################
	$imgSizer->image     = '/Celeste/imagenes/productos/'.$row_ultimos['imagen'];
	$imgSizer->resize();
				
				 ?>
            <div>
              <div class="image"><a href="producto.php?producto=<?php echo $row_ultimos['idProducto']; ?>"><img src="imagenes/productos/_min50/miniatura_<?php echo $row_ultimos['imagen']; ?>" alt="<?php echo $row_ultimos['nombreProducto']; ?>"/></a></div>
              <div class="producto.php?producto=<?php echo $row_ultimos['idProducto']; ?>"><a href="producto.php"><?php echo $row_ultimos['nombreProducto']; ?> </a></div>
              <div class="price">$<?php echo number_format($row_ultimos['precio'], 0, '', '.') ?> </div>
              <div class="rating"><img src="image/stars-5.png" alt="Based on 5 reviews." /></div>
            </div>
              <?php } while ($row_ultimos = mysql_fetch_assoc($ultimos)); ?>
            
            
          </div>
        </div>
      </div>
      <!--Latest Product End-->
      
      <div class="box">
        <div class="box-heading">Ofertas</div>
        <div class="box-content">
          <div class="box-product">
            
            
            
            
            <?php do {
				
				require_once('class.imgsizer.php');
		$imgSizer = new imgSizer();
		$imgSizer->type      = "width";
	$imgSizer->max       = 50;
	$imgSizer->quality   = 8;
	$imgSizer->square    = true;
	$imgSizer->prefix    = "miniatura_";
	$imgSizer->folder    = "_min50/";
	// Single image ##################################################
	$imgSizer->image     = '/Celeste/imagenes/productos/'.$row_ofertas['imagen'];
	$imgSizer->resize();
				
				 ?>
            <div>
              <div class="image"><a href="producto.php?producto=<?php echo $row_ofertas['idProducto']; ?>"><img src="imagenes/productos/_min50/miniatura_<?php echo $row_ofertas['imagen']; ?>" alt="<?php echo $row_ofertas['nombreProducto']; ?>"/></a></div>
              <div class="producto.php?producto=<?php echo $row_ofertas['idProducto']; ?>"><a href="producto.php"><?php echo $row_ofertas['nombreProducto']; ?> </a></div>
              <div class="price">$<?php echo number_format($row_ofertas['precio'], 0, '', '.'); ?> </div>
              <div class="rating"><img src="image/stars-5.png" alt="Based on 5 reviews." /></div>
            </div>
              <?php } while ($row_ofertas = mysql_fetch_assoc($ofertas)); ?>
            
            
          </div>
        </div>
      </div>
      
      <!--Specials Product Start-->
      
      <!--Specials Product End-->
    </div>
<?php
mysql_free_result($ultimos);

mysql_free_result($categorias);
?>
