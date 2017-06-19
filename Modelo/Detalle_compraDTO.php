<?php
class Detalle_compraDTO {
    public $idDetalle;
    public $idCompra;
    public $idProducto;
    public $precio;
    public $cantidad;

    public function Detalle_compraDTO(){
    }

    function getIdDetalle() {
        return $this->idDetalle;
    }

    function setIdDetalle($idDetalle) {
        return $this->idDetalle = $idDetalle;
    }

    function getIdCompra() {
        return $this->idCompra;
    }

    function setIdCompra($idCompra) {
        return $this->idCompra = $idCompra;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function setIdProducto($idProducto) {
        return $this->idProducto = $idProducto;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setPrecio($precio) {
        return $this->precio = $precio;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function setCantidad($cantidad) {
        return $this->cantidad = $cantidad;
    }

}