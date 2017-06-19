<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/ProductoDTO.php';

class ProductoDAO{
    private $conexion;

    public function ProductoDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idProducto) {
        $this->conexion->conectar();
        $query = "DELETE FROM producto WHERE  idProducto =  ".$idProducto." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto";
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
            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function findByID($idProducto) {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto WHERE  idProducto =  ".$idProducto." ";
        $result = $this->conexion->ejecutar($query);
        $producto = new ProductoDTO();
        while ($fila = $result->fetch_row()) {
            $producto->setIdProducto($fila[0]);
            $producto->setNombreProducto($fila[1]);
            $producto->setDescripcionProducto($fila[2]);
            $producto->setStock($fila[3]);
            $producto->setPrecio($fila[4]);
            $producto->setIdSubCategoria($fila[5]);
        }
        $this->conexion->desconectar();
        return $producto;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM producto WHERE  upper(idProducto) LIKE upper(".$cadena.")  OR  upper(nombreProducto) LIKE upper('".$cadena."')  OR  upper(descripcionProducto) LIKE upper('".$cadena."')  OR  upper(stock) LIKE upper(".$cadena.")  OR  upper(precio) LIKE upper(".$cadena.")  OR  upper(idSubCategoria) LIKE upper(".$cadena.") ";
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
            $productos[$i] = $producto;
            $i++;
        }
        $this->conexion->desconectar();
        return $productos;
    }

    public function save($producto) {
        $this->conexion->conectar();
        $query = "INSERT INTO producto (idProducto,nombreProducto,descripcionProducto,stock,precio,idSubCategoria)"
                . " VALUES ( ".$producto->getIdProducto()." , '".$producto->getNombreProducto()."' , '".$producto->getDescripcionProducto()."' ,  ".$producto->getStock()." ,  ".$producto->getPrecio()." ,  ".$producto->getIdSubCategoria()." )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($producto) {
        $this->conexion->conectar();
        $query = "UPDATE producto SET "
                . "  nombreProducto = '".$producto->getNombreProducto()."' ,"
                . "  descripcionProducto = '".$producto->getDescripcionProducto()."' ,"
                . "  stock =  ".$producto->getStock()." ,"
                . "  precio =  ".$producto->getPrecio()." ,"
                . "  idSubCategoria =  ".$producto->getIdSubCategoria()." "
                . " WHERE  idProducto =  ".$producto->getIdProducto()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}