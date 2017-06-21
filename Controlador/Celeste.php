<?php

include_once 'Mantenedores/CategoriaDAO.php';
include_once 'Mantenedores/CompraDAO.php';
include_once 'Mantenedores/Detalle_compraDAO.php';
include_once 'Mantenedores/ImagenDAO.php';
include_once 'Mantenedores/PerfilDAO.php';
include_once 'Mantenedores/ProductoDAO.php';
include_once 'Mantenedores/SubcategoriaDAO.php';
include_once 'Mantenedores/UsuarioDAO.php';

class Celeste {
    private static $instancia = NULL;
    private $categoriaDAO;
    private $compraDAO;
    private $detalle_compraDAO;
    private $imagenDAO;
    private $perfilDAO;
    private $productoDAO;
    private $subcategoriaDAO;
    private $usuarioDAO;

    public function Celeste() {
        $this->categoriaDAO = new CategoriaDAO();
        $this->compraDAO = new CompraDAO();
        $this->detalle_compraDAO = new Detalle_compraDAO();
        $this->imagenDAO = new ImagenDAO();
        $this->perfilDAO = new PerfilDAO();
        $this->productoDAO = new ProductoDAO();
        $this->subcategoriaDAO = new SubcategoriaDAO();
        $this->usuarioDAO = new UsuarioDAO();
    }

    public static function getInstancia() {
        if (self::$instancia == NULL) {
            self::$instancia = new Celeste();
        }
        return self::$instancia;
    }

    public function getAllCategorias() {
        return $this->categoriaDAO->findAll();
    }

    public function addCategoria($categoria) {
        return $this->categoriaDAO->save($categoria);
    }

    public function removeCategoria($idCategoria) {
        return $this->categoriaDAO->delete($idCategoria);
    }

    public function updateCategoria($categoria) {
        return $this->categoriaDAO->update($categoria);
    }

    public function getCategoriaByID($idCategoria) {
        return $this->categoriaDAO->findByID($idCategoria);
    }
    
    public function getCategoriaByNombre($nombreCategoria) {
        return $this->categoriaDAO->findByNombre($nombreCategoria);
    }

    public function getCategoriaLikeAtrr($cadena) {
        return $this->categoriaDAO->findLikeAtrr($cadena);
    }

    public function getAllCompras() {
        return $this->compraDAO->findAll();
    }

    public function addCompra($compra) {
        return $this->compraDAO->save($compra);
    }

    public function removeCompra($idCompra) {
        return $this->compraDAO->delete($idCompra);
    }

    public function updateCompra($compra) {
        return $this->compraDAO->update($compra);
    }

    public function getCompraByID($idCompra) {
        return $this->compraDAO->findByID($idCompra);
    }

    public function getCompraLikeAtrr($cadena) {
        return $this->compraDAO->findLikeAtrr($cadena);
    }

    public function getAllDetalle_compras() {
        return $this->detalle_compraDAO->findAll();
    }

    public function addDetalle_compra($detalle_compra) {
        return $this->detalle_compraDAO->save($detalle_compra);
    }

    public function removeDetalle_compra($idDetalle) {
        return $this->detalle_compraDAO->delete($idDetalle);
    }

    public function updateDetalle_compra($detalle_compra) {
        return $this->detalle_compraDAO->update($detalle_compra);
    }

    public function getDetalle_compraByID($idDetalle) {
        return $this->detalle_compraDAO->findByID($idDetalle);
    }

    public function getDetalle_compraLikeAtrr($cadena) {
        return $this->detalle_compraDAO->findLikeAtrr($cadena);
    }

    public function getAllImagens() {
        return $this->imagenDAO->findAll();
    }

    public function addImagen($imagen) {
        return $this->imagenDAO->save($imagen);
    }

    public function removeImagen($idImagen) {
        return $this->imagenDAO->delete($idImagen);
    }

    public function updateImagen($imagen) {
        return $this->imagenDAO->update($imagen);
    }

    public function getImagenByID($idImagen) {
        return $this->imagenDAO->findByID($idImagen);
    }
    
    public function getImagenByIdProducto($idProducto) {
        return $this->imagenDAO->findByIdProducto($idProducto);
    }

    public function getImagenLikeAtrr($cadena) {
        return $this->imagenDAO->findLikeAtrr($cadena);
    }

    public function getAllPerfils() {
        return $this->perfilDAO->findAll();
    }

    public function addPerfil($perfil) {
        return $this->perfilDAO->save($perfil);
    }

    public function removePerfil($idPerfil) {
        return $this->perfilDAO->delete($idPerfil);
    }

    public function updatePerfil($perfil) {
        return $this->perfilDAO->update($perfil);
    }

    public function getPerfilByID($idPerfil) {
        return $this->perfilDAO->findByID($idPerfil);
    }

    public function getPerfilLikeAtrr($cadena) {
        return $this->perfilDAO->findLikeAtrr($cadena);
    }

    public function getIdProducoDisponible() {
        return $this->productoDAO->idDisponible();
    }

    public function getAllProductos() {
        return $this->productoDAO->findAll();
    }
    
    public function getAllProductosBy_idSubCategoria($idSubCategoria) {
        return $this->productoDAO->findAllByIdSubCategoria($idSubCategoria);
    }

    public function addProducto($producto) {
        return $this->productoDAO->save($producto);
    }

    public function removeProducto($idProducto) {
        return $this->productoDAO->delete($idProducto);
    }

    public function updateProducto($producto) {
        return $this->productoDAO->update($producto);
    }

    public function getProductoByID($idProducto) {
        return $this->productoDAO->findByID($idProducto);
    }

    public function getProductoByNombre($nombreProducto) {
        return $this->productoDAO->findByNombre($nombreProducto);
    }

    public function getProductoLikeAtrr($cadena) {
        return $this->productoDAO->findLikeAtrr($cadena);
    }

    public function getAllSubcategorias() {
        return $this->subcategoriaDAO->findAll();
    }
    
    public function getAllSubcategoriasByIdCategoria($idCategoria) {
        return $this->subcategoriaDAO->findAllByIdCategoria($idCategoria);
    }

    public function addSubcategoria($subcategoria) {
        return $this->subcategoriaDAO->save($subcategoria);
    }

    public function removeSubcategoria($idSubCategoria) {
        return $this->subcategoriaDAO->delete($idSubCategoria);
    }

    public function updateSubcategoria($subcategoria) {
        return $this->subcategoriaDAO->update($subcategoria);
    }

    public function getSubcategoriaByID($idSubCategoria) {
        return $this->subcategoriaDAO->findByID($idSubCategoria);
    }
    
    public function getSubcategoriaByNombre($nombreSubCategoria) {
        return $this->subcategoriaDAO->findByNombre($nombreSubCategoria);
    }

    public function getSubcategoriaLikeAtrr($cadena) {
        return $this->subcategoriaDAO->findLikeAtrr($cadena);
    }

    public function getAllUsuarios() {
        return $this->usuarioDAO->findAll();
    }

    public function addUsuario($usuario) {
        return $this->usuarioDAO->save($usuario);
    }

    public function removeUsuario($run) {
        return $this->usuarioDAO->delete($run);
    }

    public function updateUsuario($usuario) {
        return $this->usuarioDAO->update($usuario);
    }

    public function getUsuarioByID($run) {
        return $this->usuarioDAO->findByID($run);
    }

    public function getUsuarioLikeAtrr($cadena) {
        return $this->usuarioDAO->findLikeAtrr($cadena);
    }

}
?>