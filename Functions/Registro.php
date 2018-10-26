<?php
//Controlador para gestion del registro
include '../Models/USUARIO_Model.php';
include '../Views/MENSAJE_Vista2.php';

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

if (isset($_REQUEST['accion'])) {

    if ($_REQUEST['accion'] == 'Registrar') {
		include '../css/header.php';
		$usuario = get_data_form();
        $respuesta = $usuario->Registro();
        if ($respuesta == 'true') {//Comprueba que el usuario se puede registrar y lo inserta
            $respuesta2 = $usuario->Insertar();
			new Mensaje2($respuesta2, 'DEFAULT_Vista_NoLogin.php');
            header('Location:../index.php');
        } else {
            new Mensaje2($respuesta, '../index.php');
        }
    }
}
?>
