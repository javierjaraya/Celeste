<?php
class CompraDTO {
    public $idCompra;
    public $fechaCompra;
    public $estado;
    public $metodoDespacho;
    public $direccionDespacho;
    public $personaRetira;
    public $run;

    public function CompraDTO(){
    }

    function getIdCompra() {
        return $this->idCompra;
    }

    function setIdCompra($idCompra) {
        return $this->idCompra = $idCompra;
    }

    function getFechaCompra() {
        return $this->fechaCompra;
    }

    function setFechaCompra($fechaCompra) {
        return $this->fechaCompra = $fechaCompra;
    }

    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        return $this->estado = $estado;
    }

    function getMetodoDespacho() {
        return $this->metodoDespacho;
    }

    function setMetodoDespacho($metodoDespacho) {
        return $this->metodoDespacho = $metodoDespacho;
    }

    function getDireccionDespacho() {
        return $this->direccionDespacho;
    }

    function setDireccionDespacho($direccionDespacho) {
        return $this->direccionDespacho = $direccionDespacho;
    }

    function getPersonaRetira() {
        return $this->personaRetira;
    }

    function setPersonaRetira($personaRetira) {
        return $this->personaRetira = $personaRetira;
    }

    function getRun() {
        return $this->run;
    }

    function setRun($run) {
        return $this->run = $run;
    }

}