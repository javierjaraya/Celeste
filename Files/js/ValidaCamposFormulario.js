/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function validarMiPerfil() {
    var email = document.getElementById('emailUsuario').value;
    if (Rut(document.getElementById('runUsuario').value)) {
        if (document.getElementById('nombresUsuario').value != "") {
            if (document.getElementById('apellidosUsuario').value != "") {
                if (email != "") {
                    if (email == document.getElementById('emailUsuarioRepetido').value) {
                        if (document.getElementById('direccionUsuario').value != "") {
                            var telefono = document.getElementById('telefonoUsuario').value;
                            if (telefono != "" && telefono.length > 5) {
                                if (!isNaN(telefono)) {
                                    return true;
                                } else {
                                    notificacion("El teléfono contiene caracteres no válidos", "warning", "alert");
                                }
                            } else {
                                notificacion("Debe ingresar una teléfono de contacto con al menos 6 dígitos", "warning", "alert");
                            }
                        } else {
                            notificacion("Debe ingresar una dirección", "warning", "alert");
                        }
                    } else {
                        notificacion("Los email no coinciden", "warning", "alert");
                    }
                } else {
                    notificacion("Debe ingresar un email", "warning", "alert");
                }
            } else {
                notificacion("Debe ingresar sus apellidos", "warning", "alert");
            }
        } else {
            notificacion("Debe ingresar sus nombres", "warning", "alert");
        }
    } else {
        notificacion("El run ingresado no es válido", "warning", "alert");
    }
    return false;
}
function validarUsuarioEditar() {
    var email = document.getElementById('emailUsuario').value;
    if (Rut(document.getElementById('runUsuario').value)) {
        if (document.getElementById('nombresUsuario').value != "") {
            if (document.getElementById('apellidosUsuario').value != "") {
                if (email != "") {
                    if (email == document.getElementById('emailUsuarioRepetido').value) {
                        if (document.getElementById('direccionUsuario').value != "") {
                            var telefono = document.getElementById('telefonoUsuario').value;
                            if (telefono != "" && telefono.length > 5) {
                                if (!isNaN(telefono)) {
                                    return true;
                                } else {
                                    notificacion("El teléfono contiene caracteres no validos", "warning", "alert-modal");
                                }
                            } else {
                                notificacion("Debe ingresar una teléfono de contacto con al menos 6 digitos", "warning", "alert-modal");
                            }
                        } else {
                            notificacion("Debe ingresar una dirección", "warning", "alert-modal");
                        }
                    } else {
                        notificacion("Los email no coinciden", "warning", "alert-modal");
                    }
                } else {
                    notificacion("Debe ingresar un email", "warning", "alert-modal");
                }
            } else {
                notificacion("Debe ingresar sus apellidos", "warning", "alert-modal");
            }
        } else {
            notificacion("Debe ingresar sus nombres", "warning", "alert-modal");
        }
    } else {
        notificacion("El run ingresado no es válido", "warning", "alert-modal");
    }
    return false;
}
function validarUsuario() {
    var email = document.getElementById('emailUsuario').value;
    var telefono = document.getElementById('telefonoUsuario').value;
    var cadenaPass = document.getElementById('contrasenaUsuario').value;
    if (Rut(document.getElementById('runUsuario').value)) {
        if (document.getElementById('nombresUsuario').value != "") {
            if (document.getElementById('apellidosUsuario').value != "") {
                if (email != "") {
                    if (email == document.getElementById('emailUsuarioRepetido').value) {
                        if (document.getElementById('direccionUsuario').value != "") {
                            if (telefono != "" && telefono.length > 5) {
                                if (!isNaN(telefono)) {
                                    if (cadenaPass.length >= 4 && cadenaPass.length <= 8) {
                                        if (cadenaPass == document.getElementById('contrasenaRepetidaUsuario').value) {
                                            return true;
                                        } else {
                                            notificacion("Las contraseñas no coinciden", "warning", "alert");
                                        }
                                    } else {
                                        notificacion("La contraseña debe tener minimo 4 caracteres y Maximo 8", "warning", "alert");
                                    }
                                } else {
                                    notificacion("El teléfono contiene caracteres no válidos", "warning", "alert");
                                }
                            } else {
                                notificacion("Debe ingresar una teléfono de contacto con al menos 6 dígitos", "warning", "alert");
                            }
                        } else {
                            notificacion("Debe ingresar una dirección", "warning", "alert");
                        }
                    } else {
                        notificacion("Los email no coinciden", "warning", "alert");
                    }
                } else {
                    notificacion("Debe ingresar un email", "warning", "alert");
                }
            } else {
                notificacion("Debe ingresar sus apellidos", "warning", "alert");
            }
        } else {
            notificacion("Debe ingresar sus nombres", "warning", "alert");
        }
    } else {
        notificacion("El run ingresado no es válido", "warning", "alert");
    }
    return false;
}
function validarClaves() {
    var cadenaPass = document.getElementById('nuevaContrasenaUsuario').value;
    if (cadenaPass.length >= 4 && cadenaPass.length <= 8) {
        if (cadenaPass == document.getElementById('contrasenaRepetidaUsuario').value) {
            return true;
        } else {
            notificacion("Las contraseñas no coinciden", "warning", "alert2");
        }
    } else {
        notificacion("La contraseña debe tener minimo 4 caracteres y Maximo 8", "warning", "alert2");
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

