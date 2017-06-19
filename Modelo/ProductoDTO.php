<?php
class ProductoDTO {
    public $idProducto;
    public $nombreProducto;
    public $descripcionProducto;
    public $stock;
    public $precio;
    public $idSubCategoria;

    public function ProductoDTO(){
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function setIdProducto($idProducto) {
        return $this->idProducto = $idProducto;
    }

    function getNombreProducto() {
        return $this->nombreProducto;
    }

    function setNombreProducto($nombreProducto) {
        return $this->nombreProducto = $nombreProducto;
    }

    function getDescripcionProducto() {
        return $this->descripcionProducto;
    }

    function setDescripcionProducto($descripcionProducto) {
        return $this->descripcionProducto = $descripcionProducto;
    }

    function getStock() {
        return $this->stock;
    }

    function setStock($stock) {
        return $this->stock = $stock;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setPrecio($precio) {
        return $this->precio = $precio;
    }

    function getIdSubCategoria() {
        return $this->idSubCategoria;
    }

    function setIdSubCategoria($idSubCategoria) {
        return $this->idSubCategoria = $idSubCategoria;
    }

}