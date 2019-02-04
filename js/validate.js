
function nif(dni) {
    var numero
    var letr
    var letra
    var expresion_regular_dni

    expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

    if (expresion_regular_dni.test(dni) == true) {
        numero = dni.substr(0, dni.length - 1);
        letr = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra != letr.toUpperCase()) {
            alert('DNI erróneo, la letra del NIF no se corresponde');
            return false;
        } else {

            return true;
        }
    } else {
        alert('DNI erroneo, formato no válido');
        return false;
    }
}

function validarEmail(email) {
    expr = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!expr.test(email)) {
        return false;
    } else {
        return true;
    }
}

function validarFechaMenorActual(date) {
    var x = new Date();
    var fecha = date.split("-");

    x.setFullYear(fecha[0], fecha[1] - 1, fecha[2]);
    var today = new Date();

    if (x >= today)
        return false;
    else
        return true;
}

function validarHora(hora) {
    var hora = hora.split(":");

    if (hora[0] < 9 or hora[0] > 21)
        return false;
    else
        return true;
}

function valida_envia_username() {
    if (document.form.username.value.length == 0) {
        alert("Introduzca un valor para el usuario");
        document.form.username.focus();
        return false;
    }

	
    if (document.form.username.value.length < 2) {
        alert("Nombre de usuario demasiado corto (mínimo 2 caracteres)");
        document.form.username.focus();
        return false;
    }
	
    if (document.form.username.value.length > 25) {
        alert("Nombre de usuario demasiado largo (máximo 25 caracteres)");
        document.form.username.focus();
        return false;
    }
	return true;
}

function valida_envia_password() {
    if (document.form.password.value.length == 0) {
        alert("Introduzca un valor para la contraseña");
        document.form.password.focus();
        return false;
    }

    if (document.form.password.value.length < 6) {
        alert("Contraseña demasiado corta (mínimo 6 caracteres)");
        document.form.password.focus();
        return false;
    }

    if (document.form.password.value.length > 32) {
        alert("Contraseña demasiado larga (máximo 32 caracteres)");
        document.form.password.focus();
        return false;
    }
	return true;
}

function valida_envia_nombre() {
    if (document.form.nombre.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.nombre.focus();
        return false;
    }
	
    if (document.form.nombre.value.length < 2) {
        alert("Nombre demasiado corto (mínimo 2 caracteres)");
        document.form.nombre.focus();
        return false;
    }
	
    if (document.form.nombre.value.length > 25) {
        alert("Nombre demasiado largo (máximo 25 caracteres)");
        document.form.nombre.focus();
        return false;
    }
	return true;
}

function valida_envia_apellidos() {
    if (document.form.apellidos.value.length == 0) {
        alert("Introduzca un valor para el apellido");
        document.form.apellidos.focus();
        return false;
    }
	
    if (document.form.apellidos.value.length < 2) {
        alert("Apellido demasiado corto (mínimo 2 caracteres)");
        document.form.apellidos.focus();
        return false;
    }
	
    if (document.form.apellidos.value.length > 50) {
        alert("Apellido demasiado largo (máximo 50 caracteres)");
        document.form.apellidos.focus();
        return false;
    }
	return true;
}
	
function valida_envia_dni() {	
    if (!nif(document.form.dni.value)) {
        document.form.dni.focus();
        return false;
    }
	return true;
}

function valida_envia_fechaNac() {
    if (document.form.fechaNac.value == false) {
        alert("Introduzca un valor  para la fecha de nacimiento");
        document.form.fechaNac.focus();
        return false;
    }

    if (!validarFechaMenorActual(document.form.fechaNac.value)) {
        alert("¿Viene del futuro? Introduzca una fecha válida");
        document.form.fechaNac.focus();
        return false;
    }
	return true;
}
	
function valida_envia_niu() {
	if (document.form.niu.value.length == 0) {
        alert("Introduzca un valor para el NIU");
        document.form.niu.focus();
        return false;
    }
	
    if (document.form.niu.value.length != 12) {
        alert("NIU inválido (exactamente 12 caracteres)");
        document.form.niu.focus();
        return false;
    }
	return true;
}

function valida_envia_email() {
    if (((document.form.email.value.length == 0) || !validarEmail(document.form.email.value))) {
        alert("Introduzca una dirección de email válida");
        document.form.email.focus();
        return false;
    }
	return true;
}

function valida_envia_USUARIO() {
    if (document.form.username.value.length == 0) {
        alert("Introduzca un valor para el usuario");
        document.form.username.focus();
        return false;
    }
	
    if (document.form.username.value.length < 2) {
        alert("Nombre de usuario demasiado corto (mínimo 2 caracteres)");
        document.form.username.focus();
        return false;
    }
	
    if (document.form.username.value.length > 25) {
        alert("Nombre de usuario demasiado largo (máximo 25 caracteres)");
        document.form.username.focus();
        return false;
    }

    if (document.form.password.value.length == 0) {
        alert("Introduzca un valor para la contraseña");
        document.form.password.focus();
        return false;
    }

    if (document.form.password.value.length < 6) {
        alert("Contraseña demasiado corta (mínimo 6 caracteres)");
        document.form.password.focus();
        return false;
    }

    if (document.form.password.value.length > 32) {
        alert("Contraseña demasiado larga (máximo 32 caracteres)");
        document.form.password.focus();
        return false;
    }

    if (document.form.nombre.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.nombre.focus();
        return false;
    }
	
    if (document.form.nombre.value.length < 2) {
        alert("Nombre demasiado corto (mínimo 2 caracteres)");
        document.form.nombre.focus();
        return false;
    }
	
    if (document.form.nombre.value.length > 25) {
        alert("Nombre demasiado largo (máximo 25 caracteres)");
        document.form.nombre.focus();
        return false;
    }


    if (document.form.apellidos.value.length == 0) {
        alert("Introduzca un valor para el apellido");
        document.form.apellidos.focus();
        return false;
    }
	
    if (document.form.apellidos.value.length < 2) {
        alert("Apellido demasiado corto (mínimo 2 caracteres)");
        document.form.apellidos.focus();
        return false;
    }
	
    if (document.form.apellidos.value.length > 50) {
        alert("Apellido demasiado largo (máximo 50 caracteres)");
        document.form.apellidos.focus();
        return false;
    }

	
    if (!nif(document.form.dni.value)) {
        document.form.dni.focus();
        return false;
    }

    if (document.form.fechaNac.value == false) {
        alert("Introduzca un valor  para la fecha de nacimiento");
        document.form.fechaNac.focus();
        return false;
    }

    if (!validarFechaMenorActual(document.form.fechaNac.value)) {
        alert("¿Viene del futuro? Introduzca una fecha válida");
        document.form.fechaNac.focus();
        return false;
    }
	
	if (document.form.niu.value.length == 0) {
        alert("Introduzca un valor para el NIU");
        document.form.niu.focus();
        return false;
    }
	
    if (document.form.niu.value.length != 12) {
        alert("NIU inválido (exactamente 12 caracteres)");
        document.form.niu.focus();
        return false;
    }

    if (((document.form.email.value.length == 0) || !validarEmail(document.form.email.value))) {
        alert("Introduzca una dirección de email válida");
        document.form.email.focus();
        return false;
    }


    return true;

}

function valida_envia_ALERTA() {
    if (document.form.asuntoAlerta.value.length == 0) {
        alert("Introduzca un valor para el asunto");
        document.form.asuntoAlerta.focus();
        return false;
    }
	
    if (document.form.asuntoAlerta.value.length < 2) {
        alert("Asunto demasiado corto (mínimo 2 caracteres)");
        document.form.asuntoAlerta.focus();
        return false;
    }
	
    if (document.form.asuntoAlerta.value.length > 50) {
        alert("Asunto demasiado largo (máximo 50 caracteres)");
        document.form.asuntoAlerta.focus();
        return false;
    }

    if (document.form.descripcionAlerta.value.length == 0) {
        alert("Introduzca un valor para la descripcion");
        document.form.descripcionAlerta.focus();
        return false;
    }
	
    if (!validarHora(document.form.hora.value)) {
		alert("Introduce una hora entre las 9 y las 21");
        document.form.hora.focus();
        return false;
    }

    return true;

}

function valida_envia_asuntoAlerta() {
    if (document.form.asuntoAlerta.value.length == 0) {
        alert("Introduzca un valor para el asunto");
        document.form.asuntoAlerta.focus();
        return false;
    }
	
    if (document.form.asuntoAlerta.value.length < 2) {
        alert("Asunto demasiado corto (mínimo 2 caracteres)");
        document.form.asuntoAlerta.focus();
        return false;
    }
	
    if (document.form.asuntoAlerta.value.length > 50) {
        alert("Asunto demasiado largo (máximo 50 caracteres)");
        document.form.asuntoAlerta.focus();
        return false;
    }
}

function valida_envia_descripcionAlerta() {
    if (document.form.descripcionAlerta.value.length == 0) {
        alert("Introduzca un valor para la descripcion");
        document.form.descripcionAlerta.focus();
        return false;
    }
}

function valida_envia_hora() {
    if (!validarHora(document.form.hora.value)) {
		alert("Introduce una hora entre las 9 y las 21");
        document.form.hora.focus();
        return false;
    }
}
