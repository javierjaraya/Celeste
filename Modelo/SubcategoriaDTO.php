<?php
class SubcategoriaDTO {
    public $idSubCategoria;
    public $nombreSubCategoria;
    public $idCategoria;

    public function SubcategoriaDTO(){
    }

    function getIdSubCategoria() {
        return $this->idSubCategoria;
    }

    function setIdSubCategoria($idSubCategoria) {
        return $this->idSubCategoria = $idSubCategoria;
    }

    function getNombreSubCategoria() {
        return $this->nombreSubCategoria;
    }

    function setNombreSubCategoria($nombreSubCategoria) {
        return $this->nombreSubCategoria = $nombreSubCategoria;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setIdCategoria($idCategoria) {
        return $this->idCategoria = $idCategoria;
    }

}