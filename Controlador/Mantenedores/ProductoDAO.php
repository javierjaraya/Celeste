<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/ProductoDTO.php';

class ProductoDAO {

    private $conexion;

    public function ProductoDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function idDisponible() {
        $this->conexion->conectar();
        $query = "SELECT (IFNULL(max(idProducto),0)+1) as id FROM producto ";
        $result = $this->conexion->ejecutar($query);
        $id = 1;
        while ($fila = $result->fetch_row()) {
            $id = $fila[0];
        }
        $this->conexion->desconectar();
        return $id;
    }

    public function delete($idProducto) {
        $this->conexion->conectar();
        $query = "DELETE FROM producto WHERE idProducto =  " . $idProducto . " ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $productos = array();
        while ($fila = $result->fetch_row()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);

            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function findAllByIdSubCategoria($idSubCategoria) {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto WHERE producto.idSubCategoria = " . $idSubCategoria;
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $productos = array();
        while ($fila = $result->fetch_row()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);

            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function findLimitByIdSubCategoria($offset, $per_page, $order, $idSubCategoria) {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto WHERE producto.idSubCategoria = " . $idSubCategoria . " " . $order . " LIMIT $offset,$per_page";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $productos = array();
        while ($fila = $result->fetch_row()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);

            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function findByID($idProducto) {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto WHERE  producto.idProducto =  " . $idProducto . " ";
        $result = $this->conexion->ejecutar($query);
        $producto = new ProductoDTO();
        while ($fila = $result->fetch_row()) {
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);
        }
        $this->conexion->desconectar();
        return $producto;
    }

    public function find_n_recientes($n) {
        $this->conexion->conectar();
        $query = " SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto ORDER BY producto.idProducto DESC LIMIT 0," . $n;
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $productos = array();
        while ($fila = $result->fetch_row()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);

            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function find_n_mas_vendidos($n) {
        $this->conexion->conectar();
        $query = "  SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto JOIN "
                . " (SELECT dc.idProducto as id, sum(dc.cantidad) as cantidad FROM detalle_compra dc GROUP BY dc.idProducto ORDER BY cantidad DESC LIMIT 0," . $n . ") as ranking "
                . " ON producto.idProducto = ranking.id ";

        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $productos = array();
        while ($fila = $result->fetch_row()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);

            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function find_n_mas_vendidos_by_fechas($n, $fecha_desde, $fecha_hasta) {
        $this->conexion->conectar();
        $query = "  SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto JOIN "
                . " (SELECT dc.idProducto as id, sum(dc.cantidad) as cantidad FROM detalle_compra dc  JOIN compra c ON dc.idCompra = c.idCompra WHERE DATE_FORMAT(c.fechaCompra, '%Y-%m-%d') BETWEEN '" . $fecha_desde . "'  AND '" . $fecha_hasta . "' GROUP BY dc.idProducto ORDER BY cantidad DESC LIMIT 0," . $n . ") as ranking "
                . " ON producto.idProducto = ranking.id ORDER BY ranking.cantidad DESC ";

        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $productos = array();
        while ($fila = $result->fetch_row()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);
            
            $producto->setCantidad($fila[11]);

            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function findByNombre($nombreProducto) {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto WHERE upper(producto.nombreProducto) LIKE upper('" . $nombreProducto . "') ";
        $result = $this->conexion->ejecutar($query);
        $producto = new ProductoDTO();
        while ($fila = $result->fetch_row()) {
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);
        }
        $this->conexion->desconectar();
        return $producto;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto JOIN imagen ON producto.idProducto = imagen.idProducto WHERE  upper(producto.nombreProducto) LIKE upper('%" . $cadena . "%')   ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $productos = array();
        while ($fila = $result->fetch_row()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);

            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[6]);
            $imagen->setNombreImagen($fila[7]);
            $imagen->setRutaImagen($fila[8]);
            $imagen->setIdProducto($fila[9]);

            $producto->setImagen($imagen);

            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function save($producto) {
        $this->conexion->conectar();
        $query = "INSERT INTO producto (idProducto,nombreProducto,descripcionProducto,stock,precio,idSubCategoria)"
                . " VALUES ( " . $producto->getIdProducto() . " , '" . $producto->getNombreProducto() . "' , '" . $producto->getDescripcionProducto() . "' ,  " . $producto->getStock() . " ,  " . $producto->getPrecio() . " ,  " . $producto->getIdSubCategoria() . " )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($producto) {
        $this->conexion->conectar();
        $query = "UPDATE producto SET "
                . "  nombreProducto = '" . $producto->getNombreProducto() . "' ,"
                . "  descripcionProducto = '" . $producto->getDescripcionProducto() . "' ,"
                . "  stock =  " . $producto->getStock() . " ,"
                . "  precio =  " . $producto->getPrecio() . " ,"
                . "  idSubCategoria =  " . $producto->getIdSubCategoria() . " "
                . " WHERE  idProducto =  " . $producto->getIdProducto() . " ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

}
