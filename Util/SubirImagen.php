<?php

/**
 * Description of SubirImagen
 *
 * @author joseline
 */
class SubirImagen {

    private $extenciones = array("image/jpg", "image/jpeg", "image/png", "image/gif"); // Tipos de archivos soportados
    private $directorio;
    private $redimensionar = FAlSE;
    private $width;
    private $height;
    private $sizeMax;
    private $name;
    private $defaulName = TRUE;

    function __construct($directorio) {
        $this->directorio = $directorio;
    }

    function set($width, $height) {
        $this->width = $width;
        $this->height = $height;
        $this->redimensionar = TRUE;
    }

    function setMaximoSize($size) {
        $this->sizeMax = $size;
    }

    function setName($name) {
        $this->name = $name;
        $this->defaulName = FALSE;
    }

    function subirMultiples($imagenes) {
        //Validar que existan imagenes a subir
        $respuesta;
        if ($imagenes["name"][0]) {
            //Si no existe la ruta, se crea.
            if (file_exists($this->directorio) || @mkdir($this->directorio)) {
                //recorremos todos los arhivos que se han subido
                for ($i = 0; $i < count($imagenes["name"]); $i++) {
                    if ($imagenes["size"][$i] <= $this->sizeMax) {
                        if ($this->validaTipo($imagenes["type"][$i])) {
                            $origen = $imagenes["tmp_name"][$i];
                            $destino = "";
                            if ($this->defaulName == TRUE) {
                                $destino = $this->directorio . $imagenes["name"][$i];
                            } else {
                                $destino = $this->directorio . $this->asignaNombre($imagenes["type"][$i], $this->name."".$i);
                            }
                            //movemos la imagen
                            if ($this->redimensionar) {
                                if ($this->redimensionar($imagenes["type"][$i], $origen, $destino)) {
                                    $respuesta = true;
                                } else {
                                    $respuesta = "no se pudo mover la imagen";
                                }
                            } else {
                                if (@move_uploaded_file($origen, $destino)) {
                                    $respuesta = "Imagen movida correctamente";
                                } else {
                                    $respuesta = "no se pudo mover la imagen";
                                }
                            }
                        } else {
                            return "Archivo no permitido: " . $imagenes["type"][$i];
                        }
                    } else {
                        return "El archivo es demasiado grande.";
                    }
                }
            } else {
                return "No se pudo crear el directorio";
            }
        } else {
            return "No hay imagenes";
        }
        return $respuesta;
    }

    function subirImagen($imagen) {
        //Validar que existan imagenes a subir
        $respuesta;
        if ($imagen["name"]) {
            //Si no existe la ruta, se crea.
            if (file_exists($this->directorio) || @mkdir($this->directorio)) {
                if ($imagen["size"] <= $this->sizeMax) {
                    if ($this->validaTipo($imagen["type"])) {
                        $origen = $imagen["tmp_name"];
                        $destino = "";
                        if ($this->defaulName == TRUE) {
                            $destino = $this->directorio . $imagen["name"];
                        } else {
                            $destino = $this->directorio . $this->asignaNombre($imagen["type"], $this->name);
                        }
                        //movemos la imagen
                        if ($this->redimensionar) {
                            if ($this->redimensionar($imagen["type"], $origen, $destino)) {
                                $respuesta = true;
                            } else {
                                $respuesta = "no se pudo mover la imagen";
                            }
                        } else {
                            if (@move_uploaded_file($origen, $destino)) {
                                $respuesta = "Imagen movida correctamente";
                            } else {
                                $respuesta = "no se pudo mover la imagen";
                            }
                        }
                    } else {
                        return "Archivo no permitido: ";
                    }
                } else {
                    return "El archivo es demasiado grande.";
                }
            } else {
                return "No se pudo crear el directorio";
            }
        } else {
            return "No hay imagenes";
        }
        return $respuesta;
    }

    function subirImagenEspecifica($imagen, $indice) {
        //Validar que existan imagenes a subir
        $respuesta;
        if ($imagen["name"][$indice]) {
            //Si no existe la ruta, se crea.
            if (file_exists($this->directorio) || @mkdir($this->directorio)) {
                if ($imagen["size"][$indice] <= $this->sizeMax) {
                    if ($this->validaTipo($imagen["type"][$indice])) {
                        $origen = $imagen["tmp_name"][$indice];
                        $destino = "";
                        if ($this->defaulName == TRUE) {
                            $destino = $this->directorio . $imagen["name"][$indice];
                        } else {
                            $destino = $this->directorio . $this->asignaNombre($imagen["type"][$indice], $this->name);
                        }
                        //movemos la imagen
                        if ($this->redimensionar) {
                            if ($this->redimensionar($imagen["type"][$indice], $origen, $destino)) {
                                $respuesta = true;
                            } else {
                                $respuesta = "no se pudo mover la imagen";
                            }
                        } else {
                            if (@move_uploaded_file($origen, $destino)) {
                                $respuesta = "Imagen movida correctamente";
                            } else {
                                $respuesta = "no se pudo mover la imagen";
                            }
                        }
                    } else {
                        return "Archivo no permitido: ";
                    }
                } else {
                    return "El archivo es demasiado grande.";
                }
            } else {
                return "No se pudo crear el directorio";
            }
        } else {
            return "No hay imagenes";
        }
        return $respuesta;
    }

    public function validaTipo($tipo) {
        // Verifica que la extensión sea permitida, según el arreglo $extenciones
        if (in_array(strtolower($tipo), $this->extenciones))
            return true;
    }

    public function redimensionar($type, $origen, $destino) {
        $tamano = list($ancho_orig, $alto_orig) = getimagesize($origen);
        $ancho_max = $this->width;
        $alto_max = $this->height;
        /* $ratio_orig = $ancho_orig / $alto_orig;
          if ($ancho_max / $alto_max > $ratio_orig) {
          $ancho_max = $alto_max * $ratio_orig;
          } else {
          $alto_max = $ancho_max / $ratio_orig;
          } */
        // Redimensionar
        $canvas = imagecreatetruecolor($ancho_max, $alto_max);
        switch ($type) {
            case "image/jpg":
            case "image/jpeg":
                $image = imagecreatefromjpeg($origen);
                imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
                imagejpeg($canvas, $destino, 100);
                return true;
                break;
            case "image/gif":
                $image = imagecreatefromgif($origen);
                imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
                imagegif($canvas, $destino);
                return true;
                break;
            case "image/png":
                $image = imagecreatefrompng($origen);
                imagecopyresampled($canvas, $image, 0, 0, 0, 0, $ancho_max, $alto_max, $ancho_orig, $alto_orig);
                imagepng($canvas, $destino, 0);
                return true;
                break;
        }
    }
    
    public function asignaNombre($type,$name) {
        // Asignamos la extensión según el tipo de archivo
        switch ($type) {
            case "image/jpg":
            case "image/jpeg":
                return $name.".jpg";
                break;
            case "image/gif":
                return $name.".gif";
                break;
            case "image/png":
                return $name.".png";
                break;
        }
        // Asignamos el nombre a la imagen según la fecha en formato aaaammddhhiiss y la extensión
        //$this->_name = date("Ymdhis") . "." . $this->extencion;
    }
}
