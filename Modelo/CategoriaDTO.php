<?php
class CategoriaDTO {
    public $idCategoria;
    public $nombreCategoria;

    public function CategoriaDTO(){
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setIdCategoria($idCategoria) {
        return $this->idCategoria = $idCategoria;
    }

    function getNombreCategoria() {
        return $this->nombreCategoria;
    }

    function setNombreCategoria($nombreCategoria) {
        return $this->nombreCategoria = $nombreCategoria;
    }

}