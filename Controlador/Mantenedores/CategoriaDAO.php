<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/CategoriaDTO.php';

class CategoriaDAO{
    private $conexion;

    public function CategoriaDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idCategoria) {
        $this->conexion->conectar();
        $query = "DELETE FROM categoria WHERE  idCategoria =  ".$idCategoria." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM categoria";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $categorias = array();
        while ($fila = $result->fetch_row()) {
            $categoria = new CategoriaDTO();
            $categoria->setIdCategoria($fila[0]);
            $categoria->setNombreCategoria($fila[1]);
            $categorias[$i] = $categoria;
            $i++;
        }
        $this->conexion->desconectar();
        return $categorias;
    }

    public function findByID($idCategoria) {
        $this->conexion->conectar();
        $query = "SELECT * FROM categoria WHERE  idCategoria =  ".$idCategoria." ";
        $result = $this->conexion->ejecutar($query);
        $categoria = new CategoriaDTO();
        while ($fila = $result->fetch_row()) {
            $categoria->setIdCategoria($fila[0]);
            $categoria->setNombreCategoria($fila[1]);
        }
        $this->conexion->desconectar();
        return $categoria;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM categoria WHERE  upper(idCategoria) LIKE upper(".$cadena.")  OR  upper(nombreCategoria) LIKE upper('".$cadena."') ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $categorias = array();
        while ($fila = $result->fetch_row()) {
            $categoria = new CategoriaDTO();
            $categoria->setIdCategoria($fila[0]);
            $categoria->setNombreCategoria($fila[1]);
            $categorias[$i] = $categoria;
            $i++;
        }
        $this->conexion->desconectar();
        return $categorias;
    }

    public function save($categoria) {
        $this->conexion->conectar();
        $query = "INSERT INTO categoria (idCategoria,nombreCategoria)"
                . " VALUES ( ".$categoria->getIdCategoria()." , '".$categoria->getNombreCategoria()."' )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($categoria) {
        $this->conexion->conectar();
        $query = "UPDATE categoria SET "
                . "  nombreCategoria = '".$categoria->getNombreCategoria()."' "
                . " WHERE  idCategoria =  ".$categoria->getIdCategoria()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}