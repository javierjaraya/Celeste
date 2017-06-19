/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
                                            $.messager.alert("Alerta", "Las contraseñas no coinciden");
                                        }
                                    } else {
                                        $.messager.alert("Alerta", "La contraseña debe tener minimo 4 caracteres");
                                    }
                                } else {
                                    $.messager.alert("Alerta", "El telefono contiene caracteres no validos");
                                }
                            } else {
                                $.messager.alert("Alerta", "Debe ingresar una telefono de contacto con al menos 6 digitos");
                            }
                        } else {
                            $.messager.alert("Alerta", "Debe ingresar una direccion");
                        }
                    } else {
                        $.messager.alert("Alerta", "Debe ingresar un email");
                    }
               
            } else {
                $.messager.alert("Alerta", "Debe ingresar sus apellidos");
            }
        } else {
            $.messager.alert("Alerta", "Debe ingresar sus nombres");
        }
    } else {
        $.messager.alert("Alerta", "El run ingresado no es valido");
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

