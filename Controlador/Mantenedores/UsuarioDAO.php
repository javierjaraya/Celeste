<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/UsuarioDTO.php';

class UsuarioDAO {

    private $conexion;

    public function UsuarioDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($run) {
        $this->conexion->conectar();
        $query = "DELETE FROM usuario WHERE  run = '" . $run . "' ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM usuario";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $usuarios = array();
        while ($fila = $result->fetch_row()) {
            $usuario = new UsuarioDTO();
            $usuario->setRun($fila[0]);
            $usuario->setNombres($fila[1]);
            $usuario->setApellidos($fila[2]);
            $usuario->setCorreoElectronico($fila[3]);
            $usuario->setTelefono($fila[4]);
            $usuario->setSexo($fila[5]);
            $usuario->setDireccion($fila[6]);
            $usuario->setClave($fila[7]);
            $usuario->setIdPerfil($fila[8]);
            $usuarios[$i] = $usuario;
            $i++;
        }
        $this->conexion->desconectar();
        return $usuarios;
    }

    public function findByID($run) {
        $this->conexion->conectar();
        $query = "SELECT u.run, u.nombres, u.apellidos, u.correoElectronico, u.telefono, u.sexo, u.direccion, u.clave, p.idPerfil, p.nombrePerfil FROM usuario u JOIN perfil p on u.idPerfil = p.idPerfil WHERE  run = '" . $run . "' ";
        $result = $this->conexion->ejecutar($query);
        $usuario = new UsuarioDTO();
        while ($fila = $result->fetch_row()) {
            $usuario->setRun($fila[0]);
            $usuario->setNombres($fila[1]);
            $usuario->setApellidos($fila[2]);
            $usuario->setCorreoElectronico($fila[3]);
            $usuario->setTelefono($fila[4]);
            $usuario->setSexo($fila[5]);
            $usuario->setDireccion($fila[6]);
            $usuario->setClave($fila[7]);
            $usuario->setIdPerfil($fila[8]);
            $usuario->setNombrePerfil($fila[9]);
        }
        $this->conexion->desconectar();
        return $usuario;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM usuario WHERE  upper(run) LIKE upper('" . $cadena . "')  OR  upper(nombres) LIKE upper('" . $cadena . "')  OR  upper(apellidos) LIKE upper('" . $cadena . "')  OR  upper(correoElectronico) LIKE upper('" . $cadena . "')  OR  upper(telefono) LIKE upper(" . $cadena . ")  OR  upper(sexo) LIKE upper('" . $cadena . "')  OR  upper(direccion) LIKE upper('" . $cadena . "')  OR  upper(clave) LIKE upper('" . $cadena . "')  OR  upper(idPerfil) LIKE upper(" . $cadena . ") ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $usuarios = array();
        while ($fila = $result->fetch_row()) {
            $usuario = new UsuarioDTO();
            $usuario->setRun($fila[0]);
            $usuario->setNombres($fila[1]);
            $usuario->setApellidos($fila[2]);
            $usuario->setCorreoElectronico($fila[3]);
            $usuario->setTelefono($fila[4]);
            $usuario->setSexo($fila[5]);
            $usuario->setDireccion($fila[6]);
            $usuario->setClave($fila[7]);
            $usuario->setIdPerfil($fila[8]);
            $usuarios[$i] = $usuario;
            $i++;
        }
        $this->conexion->desconectar();
        return $usuarios;
    }

    public function save($usuario) {
        $this->conexion->conectar();
        $query = "INSERT INTO usuario (run,nombres,apellidos,correoElectronico,telefono,sexo,direccion,clave,idPerfil)"
                . " VALUES ('" . $usuario->getRun() . "' , '" . $usuario->getNombres() . "' , '" . $usuario->getApellidos() . "' , '" . $usuario->getCorreoElectronico() . "' ,  " . $usuario->getTelefono() . " , '" . $usuario->getSexo() . "' , '" . $usuario->getDireccion() . "' , '" . $usuario->getClave() . "' ,  " . $usuario->getIdPerfil() . " )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function updateClave($usuario) {
        $this->conexion->conectar();
        $query = "UPDATE usuario SET "
                . "  clave = '" . $usuario->getClave() . "' "
                . " WHERE  run = '" . $usuario->getRun() . "' ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($usuario) {
        $this->conexion->conectar();
        $query = "UPDATE usuario SET "
                . "  nombres = '" . $usuario->getNombres() . "' ,"
                . "  apellidos = '" . $usuario->getApellidos() . "' ,"
                . "  correoElectronico = '" . $usuario->getCorreoElectronico() . "' ,"
                . "  telefono =  " . $usuario->getTelefono() . " ,"
                . "  sexo = '" . $usuario->getSexo() . "' ,"
                . "  direccion = '" . $usuario->getDireccion() . "' ,"
//                . "  clave = '".$usuario->getClave()."' ,"
                . "  idPerfil =  " . $usuario->getIdPerfil() . " "
                . " WHERE  run = '" . $usuario->getRun() . "' ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

}
