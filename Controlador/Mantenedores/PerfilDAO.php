<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/PerfilDTO.php';

class PerfilDAO{
    private $conexion;

    public function PerfilDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idPerfil) {
        $this->conexion->conectar();
        $query = "DELETE FROM perfil WHERE  idPerfil =  ".$idPerfil." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM perfil";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $perfils = array();
        while ($fila = $result->fetch_row()) {
            $perfil = new PerfilDTO();
            $perfil->setIdPerfil($fila[0]);
            $perfil->setNombrePerfil($fila[1]);
            $perfils[$i] = $perfil;
            $i++;
        }
        $this->conexion->desconectar();
        return $perfils;
    }

    public function findByID($idPerfil) {
        $this->conexion->conectar();
        $query = "SELECT * FROM perfil WHERE  idPerfil =  ".$idPerfil." ";
        $result = $this->conexion->ejecutar($query);
        $perfil = new PerfilDTO();
        while ($fila = $result->fetch_row()) {
            $perfil->setIdPerfil($fila[0]);
            $perfil->setNombrePerfil($fila[1]);
        }
        $this->conexion->desconectar();
        return $perfil;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM perfil WHERE  upper(idPerfil) LIKE upper(".$cadena.")  OR  upper(nombrePerfil) LIKE upper('".$cadena."') ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $perfils = array();
        while ($fila = $result->fetch_row()) {
            $perfil = new PerfilDTO();
            $perfil->setIdPerfil($fila[0]);
            $perfil->setNombrePerfil($fila[1]);
            $perfils[$i] = $perfil;
            $i++;
        }
        $this->conexion->desconectar();
        return $perfils;
    }

    public function save($perfil) {
        $this->conexion->conectar();
        $query = "INSERT INTO perfil (idPerfil,nombrePerfil)"
                . " VALUES ( ".$perfil->getIdPerfil()." , '".$perfil->getNombrePerfil()."' )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($perfil) {
        $this->conexion->conectar();
        $query = "UPDATE perfil SET "
                . "  nombrePerfil = '".$perfil->getNombrePerfil()."' "
                . " WHERE  idPerfil =  ".$perfil->getIdPerfil()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}