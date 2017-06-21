<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/ImagenDTO.php';

class ImagenDAO{
    private $conexion;

    public function ImagenDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idImagen) {
        $this->conexion->conectar();
        $query = "DELETE FROM imagen WHERE  idImagen =  ".$idImagen." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM imagen";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $imagens = array();
        while ($fila = $result->fetch_row()) {
            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[0]);
            $imagen->setNombreImagen($fila[1]);
            $imagen->setRutaImagen($fila[2]);
            $imagen->setIdProducto($fila[3]);
            $imagens[$i] = $imagen;
            $i++;
        }
        $this->conexion->desconectar();
        return $imagens;
    }

    public function findByID($idImagen) {
        $this->conexion->conectar();
        $query = "SELECT * FROM imagen WHERE  idImagen =  ".$idImagen." ";
        $result = $this->conexion->ejecutar($query);
        $imagen = new ImagenDTO();
        while ($fila = $result->fetch_row()) {
            $imagen->setIdImagen($fila[0]);
            $imagen->setNombreImagen($fila[1]);
            $imagen->setRutaImagen($fila[2]);
            $imagen->setIdProducto($fila[3]);
        }
        $this->conexion->desconectar();
        return $imagen;
    }
    
    public function findByIdProducto($idProducto) {
        $this->conexion->conectar();
        $query = "SELECT * FROM imagen WHERE  idProducto =  ".$idProducto." ";
        $result = $this->conexion->ejecutar($query);
        $imagen = new ImagenDTO();
        while ($fila = $result->fetch_row()) {
            $imagen->setIdImagen($fila[0]);
            $imagen->setNombreImagen($fila[1]);
            $imagen->setRutaImagen($fila[2]);
            $imagen->setIdProducto($fila[3]);
        }
        $this->conexion->desconectar();
        return $imagen;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM imagen WHERE  upper(idImagen) LIKE upper(".$cadena.")  OR  upper(nombreImagen) LIKE upper('".$cadena."')  OR  upper(rutaImagen) LIKE upper('".$cadena."')  OR  upper(idProducto) LIKE upper(".$cadena.") ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $imagens = array();
        while ($fila = $result->fetch_row()) {
            $imagen = new ImagenDTO();
            $imagen->setIdImagen($fila[0]);
            $imagen->setNombreImagen($fila[1]);
            $imagen->setRutaImagen($fila[2]);
            $imagen->setIdProducto($fila[3]);
            $imagens[$i] = $imagen;
            $i++;
        }
        $this->conexion->desconectar();
        return $imagens;
    }

    public function save($imagen) {
        $this->conexion->conectar();
        $query = "INSERT INTO imagen (nombreImagen,rutaImagen,idProducto)"
                . " VALUES ( '".$imagen->getNombreImagen()."' , '".$imagen->getRutaImagen()."' ,  ".$imagen->getIdProducto()." )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($imagen) {
        $this->conexion->conectar();
        $query = "UPDATE imagen SET "
                . "  nombreImagen = '".$imagen->getNombreImagen()."' ,"
                . "  rutaImagen = '".$imagen->getRutaImagen()."' ,"
                . "  idProducto =  ".$imagen->getIdProducto()." "
                . " WHERE  idImagen =  ".$imagen->getIdImagen()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}