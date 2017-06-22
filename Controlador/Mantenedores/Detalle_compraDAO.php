<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/Detalle_compraDTO.php';

class Detalle_compraDAO{
    private $conexion;

    public function Detalle_compraDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idDetalle) {
        $this->conexion->conectar();
        $query = "DELETE FROM detalle_compra WHERE  idDetalle =  ".$idDetalle." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM detalle_compra";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $detalle_compras = array();
        while ($fila = $result->fetch_row()) {
            $detalle_compra = new Detalle_compraDTO();
            $detalle_compra->setIdDetalle($fila[0]);
            $detalle_compra->setIdCompra($fila[1]);
            $detalle_compra->setIdProducto($fila[2]);
            $detalle_compra->setPrecio($fila[3]);
            $detalle_compra->setCantidad($fila[4]);
            $detalle_compras[$i] = $detalle_compra;
            $i++;
        }
        $this->conexion->desconectar();
        return $detalle_compras;
    }

    public function findByID($idDetalle) {
        $this->conexion->conectar();
        $query = "SELECT * FROM detalle_compra WHERE  idDetalle =  ".$idDetalle." ";
        $result = $this->conexion->ejecutar($query);
        $detalle_compra = new Detalle_compraDTO();
        while ($fila = $result->fetch_row()) {
            $detalle_compra->setIdDetalle($fila[0]);
            $detalle_compra->setIdCompra($fila[1]);
            $detalle_compra->setIdProducto($fila[2]);
            $detalle_compra->setPrecio($fila[3]);
            $detalle_compra->setCantidad($fila[4]);
        }
        $this->conexion->desconectar();
        return $detalle_compra;
    }
        public function findAllByIDCompra($idCompra) {
        $this->conexion->conectar();
        $query = "SELECT dc.idDetalle, dc.idCompra, dc.idProducto, dc.precio, dc.cantidad, p.nombreProducto FROM detalle_compra as dc join producto as p on p.idProducto = dc.idProducto where dc.idCompra = ".$idCompra;
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $detalle_compras = array();
        while ($fila = $result->fetch_row()) {
            $detalle_compra = new Detalle_compraDTO();
            $detalle_compra->setIdDetalle($fila[0]);
            $detalle_compra->setIdCompra($fila[1]);
            $detalle_compra->setIdProducto($fila[2]);
            $detalle_compra->setPrecio($fila[3]);
            $detalle_compra->setCantidad($fila[4]);
            $detalle_compra->setNombreProducto($fila[5]);
            $detalle_compras[$i] = $detalle_compra;
            $i++;
        }
        $this->conexion->desconectar();
        return $detalle_compras;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM detalle_compra WHERE  upper(idDetalle) LIKE upper(".$cadena.")  OR  upper(idCompra) LIKE upper(".$cadena.")  OR  upper(idProducto) LIKE upper(".$cadena.")  OR  upper(precio) LIKE upper(".$cadena.")  OR  upper(cantidad) LIKE upper(".$cadena.") ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $detalle_compras = array();
        while ($fila = $result->fetch_row()) {
            $detalle_compra = new Detalle_compraDTO();
            $detalle_compra->setIdDetalle($fila[0]);
            $detalle_compra->setIdCompra($fila[1]);
            $detalle_compra->setIdProducto($fila[2]);
            $detalle_compra->setPrecio($fila[3]);
            $detalle_compra->setCantidad($fila[4]);
            $detalle_compras[$i] = $detalle_compra;
            $i++;
        }
        $this->conexion->desconectar();
        return $detalle_compras;
    }

    public function save($detalle_compra) {
        $this->conexion->conectar();
        $query = "INSERT INTO detalle_compra (idDetalle,idCompra,idProducto,precio,cantidad)"
                . " VALUES ( ".$detalle_compra->getIdDetalle()." ,  ".$detalle_compra->getIdCompra()." ,  ".$detalle_compra->getIdProducto()." ,  ".$detalle_compra->getPrecio()." ,  ".$detalle_compra->getCantidad()." )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($detalle_compra) {
        $this->conexion->conectar();
        $query = "UPDATE detalle_compra SET "
                . "  idCompra =  ".$detalle_compra->getIdCompra()." ,"
                . "  idProducto =  ".$detalle_compra->getIdProducto()." ,"
                . "  precio =  ".$detalle_compra->getPrecio()." ,"
                . "  cantidad =  ".$detalle_compra->getCantidad()." "
                . " WHERE  idDetalle =  ".$detalle_compra->getIdDetalle()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}