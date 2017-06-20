<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdateImagen
 *
 * @author joseline
 */
class UpdateImagen {

    private $extenciones = array("image/jpg", "image/jpeg", "image/png", "image/gif"); // Tipos de archivos soportados
    private $width = 640; // Ancho máximo por defecto
    private $height = 420; // Alto máximo por defecto
    private $size = 200000; // Peso máximo. MAX_FILE_SIZE sobrescribe este valor
    private $nombre = "imagen"; // Nombre por defecto 
    private $rutaDestino;
    private $imagen;
    private $redimensionar;
    private $resultado = "";

    public function UpdateImagen($nombre, $imagen, $size, $rutaDestino, $width, $height, $redimensionar) {
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->size = $size;
        $this->rutaDestino = $rutaDestino;
        $this->redimensionar = $redimensionar;
        $this->width = $width;
        $this->height = $height;
    }

    public function update() {
        //Vemos si no pesa más que el máximo definido en $size
        if ($this->imagen['size'] <= $this->size) {
            // Vemos si hay error
            $error = $this->imagen['error'];
            switch ($error) {
                case 0:
                    if ($this->validaTipo()) {// Verificamos que el tipo de archivo sea válido, de ser así, subimos                    
                        // Vemos si es mayor al tamaño por defecto
                        $tamano = list($ancho_orig, $alto_orig) = getimagesize($this->imagen['tmp_name']);
                        $origen = $this->imagen['tmp_name'];
                        // Verificamos que exista el destino, si no, lo creamos
                        if ($this->rutaDestino != "" && !is_dir($this->rutaDestino)) {
                            mkdir($this->rutaDestino, 0775); //Creamos destino
                        }
                        $destino = $this->rutaDestino . $this->nombre;
                        $ancho_max = $this->width;
                        $alto_max = $this->height;

                        if ($this->redimensionar) {
                            /*$ratio_orig = $ancho_orig / $alto_orig;
                            if ($ancho_max / $alto_max > $ratio_orig) {
                                $ancho_max = $alto_max * $ratio_orig;
                            } else {
                                $alto_max = $ancho_max / $ratio_orig;
                            }*/
                            // Redimensionar
                            $canvas = imagecreatetruecolor($ancho_max, $alto_max);
                            switch ($this->imagen['type']) {
                                case "image/jpg":
                                case "image/jpeg":
                                    $image = imagecreatefromjpeg($origen);
                                    imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
                                    imagejpeg($canvas, $destino, 100);
                                    $this->resultado = true;
                                    break;
                                case "image/gif":
                                    $image = imagecreatefromgif($origen);
                                    imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
                                    imagegif($canvas, $destino);
                                    $this->resultado = true;
                                    break;
                                case "image/png":
                                    $image = imagecreatefrompng($origen);
                                    imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
                                    imagepng($canvas, $destino, 0);
                                    $this->resultado = true;
                                    break;
                            }
                        } else {
                            move_uploaded_file($origen, $destino); //Subir archivo sin modificarlo
                            $this->resultado = true;
                        }
                    } else {
                        $this->resultado = "Tipo de archivo no válido.";
                    }
                    break;
                case 1:
                case 2:
                    $this->resultado = "[" . $error . "] La imagen excede el tamaño máximo soportado.";
                    break;
                case 3:
                    $this->resultado = "[" . $error . "] La imagen no se subió correctamente.";
                    break;
                case 4:
                    $this->resultado = "[" . $error . "] Se debe seleccionar un archivo.";
                    break;
            }
        } else {
            $this->resultado = "La imagen es muy pesada.";
        }
        return $this->resultado;
    }

    public function validaTipo() {
        // Verifica que la extensión sea permitida, según el arreglo $extenciones
        if (in_array(strtolower($this->imagen['type']), $this->extenciones))
            return true;
    }

}
