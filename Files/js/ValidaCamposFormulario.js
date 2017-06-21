/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function validarUsuarioEditar() {
    if (Rut(document.getElementById('runUsuario').value)) {
        if (document.getElementById('nombresUsuario').value != "") {
            if (document.getElementById('apellidosUsuario').value != "") {
                    if (document.getElementById('emailUsuario').value != "") {
                        if (document.getElementById('direccionUsuario').value != "") {
                            var telefono = document.getElementById('telefonoUsuario').value;
                            if (telefono != "" && telefono.length > 5) {
                                if (!isNaN(telefono)) {                                    
                                            return true;                                       
                                } else {
                                    notificacion("El telefono contiene caracteres no validos", "warning" , "alert-modal");
                                }
                            } else {
                                notificacion("Debe ingresar una telefono de contacto con al menos 6 digitos", "warning" , "alert-modal");
                            }
                        } else {
                            notificacion("Debe ingresar una direccion", "warning" , "alert-modal");
                        }
                    } else {
                        notificacion("Debe ingresar un email", "warning" , "alert-modal");
                    }               
            } else {
                notificacion("Debe ingresar sus apellidos", "warning" , "alert-modal");
            }
        } else {
            notificacion("Debe ingresar sus nombres", "warning" , "alert-modal");
        }
    } else {
        notificacion("El run ingresado no es valido", "warning" , "alert-modal");
    }
    return false;
}

function validarUsuario() {
    if (Rut(document.getElementById('runUsuario').value)) {
        if (document.getElementById('nombresUsuario').value != "") {
            if (document.getElementById('apellidosUsuario').value != "") {
                    if (document.getElementById('emailUsuario').value != "") {
                        if (document.getElementById('direccionUsuario').value != "") {
                            var telefono = document.getElementById('telefonoUsuario').value;
                            if (telefono != "" && telefono.length > 5) {
                                if (!isNaN(telefono)) {
                                    var cadenaPass = document.getElementById('contrasenaUsuario').value;
                                    if (cadenaPass.length >= 4) {
                                        if (cadenaPass == document.getElementById('contrasenaRepetidaUsuario').value) {
                                            return true;
                                        } else {
                                            notificacion("Las contraseñas no coinciden", "warning" , "alert");
                                        }
                                    } else {
                                        notificacion("La contraseña debe tener minimo 4 caracteres", "warning" , "alert");
                                    }
                                } else {
                                    notificacion("El telefono contiene caracteres no validos", "warning" , "alert");
                                }
                            } else {
                                notificacion("Debe ingresar una telefono de contacto con al menos 6 digitos", "warning" , "alert");
                            }
                        } else {
                            notificacion("Debe ingresar una direccion", "warning" , "alert");
                        }
                    } else {
                        notificacion("Debe ingresar un email", "warning" , "alert");
                    }               
            } else {
                notificacion("Debe ingresar sus apellidos", "warning" , "alert");
            }
        } else {
            notificacion("Debe ingresar sus nombres", "warning" , "alert");
        }
    } else {
        notificacion("El run ingresado no es valido", "warning" , "alert");
    }
    return false;
}

function eliminarCaracteres() {
    var aux = String(document.getElementById("runUsuario").value);
    aux = aux.replace('.', '');
    aux = aux.replace('.', '');
    aux = aux.replace('-', '');
    document.getElementById("runUsuario").value = aux;
}
function fechaActual() {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    hoy = yyyy + "-" + mm + "-" + dd;
    return hoy;
}

