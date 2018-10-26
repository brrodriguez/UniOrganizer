<?php
//Controlador para la gestión de usuarios
include_once '../Models/USUARIO_Model.php';
include_once '../Views/MENSAJE_Vista.php';

if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include_once '../Views/header.php';
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';

$pags = generarIncludes(); //Realizamos los includes de las páginas a las que tiene acceso
for ($z = 0; $z < count($pags); $z++) {
    include_once $pags[$z];
}

//Método que recoge la información del formulario para usuarios
function get_data_form() {

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
	$tipoUsuario = $_REQUEST['tipoUsuario'];
    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellidos'];
    $dni = $_REQUEST['dni'];
    $fechaNac = $_REQUEST['fechaNac'];
    $niu = $_REQUEST['niu'];
    $email = $_REQUEST['email'];
    if (!isset($_REQUEST['newPassword']) || $_REQUEST['newPassword'] == '') {
        $newPassword = '';
    } else {
        $newPassword = $_REQUEST['newPassword'];
    }
    $usuario = new USUARIO_Modelo($username, $password, $tipoUsuario, $nombre, $apellidos, $dni, $fechaNac, $niu, $email, $newPassword);

    return $usuario;
}


if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}

Switch ($_REQUEST['accion']) { //Actúa según la acción elegida
	case $strings['Seleccionar']:
            if ($_REQUEST['user'] == "admin") {
				$numCalendarios = ObtenerNumCalendarios();
				if (!tienePermisos('USUARIO_Select')) {
                    new Mensaje('No tienes los permisos necesarios', 'USUARIO_Controller.php');
                } else {
                    new USUARIO_Insertar('USUARIO_Controller.php?user=admin', $numCalendarios );
                }
			} else {
				new Mensaje("Error, no eres administrador", 'USUARIO_Controller.php');
            }
        break;
		
    case $strings['Insertar']:
	
		if ($_REQUEST['user'] == "admin") {
            if (!isset($_REQUEST['nombre'])) { //Si no se ha introducido ningun valor, mostramos la vista con el formulario
                new USUARIO_Insertar('USUARIO_Controller.php?user=admin', 1);
            } else {
                $usuario = get_data_form();

                $respuesta = $usuario->Insertar();
                new Mensaje($respuesta, 'USUARIO_Controller.php');
            }
        }else{
			 new Mensaje('No tienes los permisos necesarios', 'USUARIO_Controller.php');
		}
        break;

    case $strings['Modificar']:

            if (!isset($_REQUEST['dni'])) {
                //Crea un usuario solo con el user para posteriormente rellenar el formulario con sus datos
                $usuario = new USUARIO_Modelo($_REQUEST['username'], '', ConsultarTipoUsuario($_REQUEST['username']), '', '', '', '', '', '', '', '');
                $valores = $usuario->RellenaDatos();
                if (!tienePermisos('USUARIO_Modificar')) {
                    new Mensaje('No tienes los permisos necesarios', 'USUARIO_Controller.php');
                } else {
                    //Muestra el formulario de modificación
                    new USUARIO_Modificar($valores, 'USUARIO_Controller.php');
                }
            } else {
                $usuario = get_data_form();

                $respuesta = $usuario->Modificar();
                new Mensaje($respuesta, 'USUARIO_Controller.php');
            }       
        break;


    case $strings['Borrar']:

        if (ConsultarTipoUsuario($_REQUEST['username']) == 1) {
            if (!isset($_REQUEST['nombre'])) {
                //Crea un usuario solo con el user para rellenar posteriormente sus datos y mostrarlos en el formulario
                $usuario = new USUARIO_Modelo($_REQUEST['username'], '', ConsultarTipoUsuario($_REQUEST['username']), '', '', '', '', '', '', '', '');
                $valores = $usuario->RellenaDatos();
                if (!tienePermisos('USUARIO_Borrar')) {
                    new Mensaje('No tienes los permisos necesarios', 'USUARIO_Controller.php');
                } else {
                    //Muestra el formulario de borrado
                    new USUARIO_Borrar($valores, 'USUARIO_Controller.php');
                }
            } else {
                $_REQUEST['password'] = '';
                $usuario = get_data_form();
                $respuesta = $usuario->Borrar();
                new Mensaje($respuesta, 'USUARIO_Controller.php');
            }
        }else{
			 new Mensaje('No tienes los permisos necesarios', 'USUARIO_Controller.php');
		}
        break;

    case $strings['Ver']:

            if (!isset($_REQUEST['nombre'])) {
                //Crea un usuario solo con el user para rellenar posteriormente sus datos y mostrarlos en el formulario
                $usuario = new USUARIO_Modelo($_REQUEST['username'], '', ConsultarTipoUsuario($_REQUEST['username']), '', '', '', '', '', '', '', '');
                $valores = $usuario->RellenaDatos();
                if (!tienePermisos('USUARIO_SELECT_SHOW')) {
                    new Mensaje('No tienes los permisos necesarios', 'USUARIO_Controller.php');
                } else {
                    //Muestra la vista con los datos del usuario
                    new USUARIO_SELECT_SHOW($valores, 'USUARIO_Controller.php');
                }
            } else {
                $_REQUEST['password'] = '';
                $usuario = get_data_form();
                $respuesta = $usuario->Borrar();
                new Mensaje($respuesta, 'USUARIO_Controller.php');
            }
        
		break;

    default: //Por defecto se realiza el show all
        if (!isset($_REQUEST['username'])) {
            $usuario = new USUARIO_Modelo('', '', '', '', '', '', '', '', '', '', '');
        } else {
            $usuario = get_data_form();
        }
        if (!isset($_REQUEST['user'])) {
            $_REQUEST['user'] = '';
        }
        $datos = $usuario->ConsultarTodo($_REQUEST['user']);

        if (!tienePermisos('USUARIO_Show')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new USUARIO_Show($datos, '../Views/DEFAULT_Vista.php');
        }
	
}
?>
