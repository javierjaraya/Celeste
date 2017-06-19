<?php
class ImagenDTO {
    public $idImagen;
    public $nombreImagen;
    public $rutaImagen;
    public $idProducto;

    public function ImagenDTO(){
    }

    function getIdImagen() {
        return $this->idImagen;
    }

    function setIdImagen($idImagen) {
        return $this->idImagen = $idImagen;
    }

    function getNombreImagen() {
        return $this->nombreImagen;
    }

    function setNombreImagen($nombreImagen) {
        return $this->nombreImagen = $nombreImagen;
    }

    function getRutaImagen() {
        return $this->rutaImagen;
    }

    function setRutaImagen($rutaImagen) {
        return $this->rutaImagen = $rutaImagen;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function setIdProducto($idProducto) {
        return $this->idProducto = $idProducto;
    }

}