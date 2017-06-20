<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/SubcategoriaDTO.php';

class SubcategoriaDAO{
    private $conexion;

    public function SubcategoriaDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idSubCategoria) {
        $this->conexion->conectar();
        $query = "DELETE FROM subcategoria WHERE  idSubCategoria =  ".$idSubCategoria." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM subcategoria";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $subcategorias = array();
        while ($fila = $result->fetch_row()) {
            $subcategoria = new SubcategoriaDTO();
            $subcategoria->setIdSubCategoria($fila[0]);
            $subcategoria->setNombreSubCategoria($fila[1]);
            $subcategoria->setIdCategoria($fila[2]);
            $subcategorias[$i] = $subcategoria;
            $i++;
        }
        $this->conexion->desconectar();
        return $subcategorias;
    }
    
    public function findAllByIdCategoria($idCategoria) {
        $this->conexion->conectar();
        $query = "SELECT * FROM subcategoria WHERE idCategoria =  ".$idCategoria." ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $subcategorias = array();
        while ($fila = $result->fetch_row()) {
            $subcategoria = new SubcategoriaDTO();
            $subcategoria->setIdSubCategoria($fila[0]);
            $subcategoria->setNombreSubCategoria($fila[1]);
            $subcategoria->setIdCategoria($fila[2]);
            $subcategorias[$i] = $subcategoria;
            $i++;
        }
        $this->conexion->desconectar();
        return $subcategorias;
    }

    public function findByID($idSubCategoria) {
        $this->conexion->conectar();
        $query = "SELECT * FROM subcategoria WHERE  idSubCategoria =  ".$idSubCategoria." ";
        $result = $this->conexion->ejecutar($query);
        $subcategoria = new SubcategoriaDTO();
        while ($fila = $result->fetch_row()) {
            $subcategoria->setIdSubCategoria($fila[0]);
            $subcategoria->setNombreSubCategoria($fila[1]);
            $subcategoria->setIdCategoria($fila[2]);
        }
        $this->conexion->desconectar();
        return $subcategoria;
    }
    
    public function findByNombre($nombreSubCategoria) {
        $this->conexion->conectar();
        $query = "SELECT * FROM subcategoria WHERE  nombreSubCategoria =  '".$nombreSubCategoria."' ";
        $result = $this->conexion->ejecutar($query);
        $subcategoria = new SubcategoriaDTO();
        while ($fila = $result->fetch_row()) {
            $subcategoria->setIdSubCategoria($fila[0]);
            $subcategoria->setNombreSubCategoria($fila[1]);
            $subcategoria->setIdCategoria($fila[2]);
        }
        $this->conexion->desconectar();
        return $subcategoria;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM subcategoria WHERE  upper(idSubCategoria) LIKE upper(".$cadena.")  OR  upper(nombreSubCategoria) LIKE upper('".$cadena."')  OR  upper(idCategoria) LIKE upper(".$cadena.") ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $subcategorias = array();
        while ($fila = $result->fetch_row()) {
            $subcategoria = new SubcategoriaDTO();
            $subcategoria->setIdSubCategoria($fila[0]);
            $subcategoria->setNombreSubCategoria($fila[1]);
            $subcategoria->setIdCategoria($fila[2]);
            $subcategorias[$i] = $subcategoria;
            $i++;
        }
        $this->conexion->desconectar();
        return $subcategorias;
    }

    public function save($subcategoria) {
        $this->conexion->conectar();
        $query = "INSERT INTO subcategoria (nombreSubCategoria,idCategoria)"
                . " VALUES ( '".$subcategoria->getNombreSubCategoria()."' ,  ".$subcategoria->getIdCategoria()." )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($subcategoria) {
        $this->conexion->conectar();
        $query = "UPDATE subcategoria SET "
                . "  nombreSubCategoria = '".$subcategoria->getNombreSubCategoria()."' ,"
                . "  idCategoria =  ".$subcategoria->getIdCategoria()." "
                . " WHERE  idSubCategoria =  ".$subcategoria->getIdSubCategoria()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}