<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/CompraDTO.php';

class CompraDAO{
    private $conexion;

    public function CompraDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idCompra) {
        $this->conexion->conectar();
        $query = "DELETE FROM compra WHERE  idCompra =  ".$idCompra." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM compra";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $compras = array();
        while ($fila = $result->fetch_row()) {
            $compra = new CompraDTO();
            $compra->setIdCompra($fila[0]);
            $compra->setFechaCompra($fila[1]);
            $compra->setEstado($fila[2]);
            $compra->setMetodoDespacho($fila[3]);
            $compra->setDireccionDespacho($fila[4]);
            $compra->setPersonaRetira($fila[5]);
            $compra->setRun($fila[6]);
            $compras[$i] = $compra;
            $i++;
        }
        $this->conexion->desconectar();
        return $compras;
    }
    public function miFindAll($run) {
        $this->conexion->conectar();
        $query = "SELECT * FROM compra where run = '".$run."'";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $compras = array();
        while ($fila = $result->fetch_row()) {
            $compra = new CompraDTO();
            $compra->setIdCompra($fila[0]);
            $compra->setFechaCompra($fila[1]);
            $compra->setEstado($fila[2]);
            $compra->setMetodoDespacho($fila[3]);
            $compra->setDireccionDespacho($fila[4]);
            $compra->setPersonaRetira($fila[5]);
            $compra->setRun($fila[6]);
            $compras[$i] = $compra;
            $i++;
        }
        $this->conexion->desconectar();
        return $compras;
    }

    public function findByID($idCompra) {
        $this->conexion->conectar();
        $query = "SELECT * FROM compra WHERE  idCompra =  ".$idCompra." ";
        $result = $this->conexion->ejecutar($query);
        $compra = new CompraDTO();
        while ($fila = $result->fetch_row()) {
            $compra->setIdCompra($fila[0]);
            $compra->setFechaCompra($fila[1]);
            $compra->setEstado($fila[2]);
            $compra->setMetodoDespacho($fila[3]);
            $compra->setDireccionDespacho($fila[4]);
            $compra->setPersonaRetira($fila[5]);
            $compra->setRun($fila[6]);
        }
        $this->conexion->desconectar();
        return $compra;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM compra WHERE  upper(idCompra) LIKE upper(".$cadena.")  OR  upper(fechaCompra) LIKE upper(".$cadena.")  OR  upper(estado) LIKE upper('".$cadena."')  OR  upper(metodoDespacho) LIKE upper('".$cadena."')  OR  upper(direccionDespacho) LIKE upper('".$cadena."')  OR  upper(personaRetira) LIKE upper('".$cadena."')  OR  upper(run) LIKE upper('".$cadena."') ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $compras = array();
        while ($fila = $result->fetch_row()) {
            $compra = new CompraDTO();
            $compra->setIdCompra($fila[0]);
            $compra->setFechaCompra($fila[1]);
            $compra->setEstado($fila[2]);
            $compra->setMetodoDespacho($fila[3]);
            $compra->setDireccionDespacho($fila[4]);
            $compra->setPersonaRetira($fila[5]);
            $compra->setRun($fila[6]);
            $compras[$i] = $compra;
            $i++;
        }
        $this->conexion->desconectar();
        return $compras;
    }

    public function save($compra) {
        $this->conexion->conectar();
        $query = "INSERT INTO compra (idCompra,fechaCompra,estado,metodoDespacho,direccionDespacho,personaRetira,run)"
                . " VALUES ( ".$compra->getIdCompra()." , ".$compra->getFechaCompra()." , '".$compra->getEstado()."' , '".$compra->getMetodoDespacho()."' , '".$compra->getDireccionDespacho()."' , '".$compra->getPersonaRetira()."' , '".$compra->getRun()."' )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
    public function updateEstado($compra) {
        $this->conexion->conectar();
        $query = "UPDATE compra SET "
                . "  estado = '".$compra->getEstado()."'"                
                . " WHERE  idCompra =  ".$compra->getIdCompra()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
    public function update($compra) {
        $this->conexion->conectar();
        $query = "UPDATE compra SET "
                . "  fechaCompra = ".$compra->getFechaCompra()." ,"
                . "  estado = '".$compra->getEstado()."' ,"
                . "  metodoDespacho = '".$compra->getMetodoDespacho()."' ,"
                . "  direccionDespacho = '".$compra->getDireccionDespacho()."' ,"
                . "  personaRetira = '".$compra->getPersonaRetira()."' ,"
                . "  run = '".$compra->getRun()."' "
                . " WHERE  idCompra =  ".$compra->getIdCompra()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}