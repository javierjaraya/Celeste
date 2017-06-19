<?php
class PerfilDTO {
    public $idPerfil;
    public $nombrePerfil;

    public function PerfilDTO(){
    }

    function getIdPerfil() {
        return $this->idPerfil;
    }

    function setIdPerfil($idPerfil) {
        return $this->idPerfil = $idPerfil;
    }

    function getNombrePerfil() {
        return $this->nombrePerfil;
    }

    function setNombrePerfil($nombrePerfil) {
        return $this->nombrePerfil = $nombrePerfil;
    }

}