<?php
class UsuarioDTO {
    public $run;
    public $nombres;
    public $apellidos;
    public $correoElectronico;
    public $telefono;
    public $sexo;
    public $direccion;
    public $clave;
    public $idPerfil;

    public function UsuarioDTO(){
    }

    function getRun() {
        return $this->run;
    }

    function setRun($run) {
        return $this->run = $run;
    }

    function getNombres() {
        return $this->nombres;
    }

    function setNombres($nombres) {
        return $this->nombres = $nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function setApellidos($apellidos) {
        return $this->apellidos = $apellidos;
    }

    function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    function setCorreoElectronico($correoElectronico) {
        return $this->correoElectronico = $correoElectronico;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setTelefono($telefono) {
        return $this->telefono = $telefono;
    }

    function getSexo() {
        return $this->sexo;
    }

    function setSexo($sexo) {
        return $this->sexo = $sexo;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function setDireccion($direccion) {
        return $this->direccion = $direccion;
    }

    function getClave() {
        return $this->clave;
    }

    function setClave($clave) {
        return $this->clave = $clave;
    }

    function getIdPerfil() {
        return $this->idPerfil;
    }

    function setIdPerfil($idPerfil) {
        return $this->idPerfil = $idPerfil;
    }

}