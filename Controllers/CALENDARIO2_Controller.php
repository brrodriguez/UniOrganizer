<?php

//Controlador para la gestión de usuarios
include '../Models/SESION_Model.php';
include '../Views/MENSAJE_Vista.php';


if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include '../Views/header.php';
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}

$pags = generarIncludes(); //Realizamos los includes de las páginas a las que tiene acceso
for ($z = 0; $z < count($pags); $z++) {
    include $pags[$z];
}

Switch ($_REQUEST['accion']) { //Actúa según la acción elegida
    case $strings['InsertarSesion']:
        if (!tienePermisos('SESION_Insertar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            if (!isset($_REQUEST['comentarioSesion'])) {
                $tabla = (Integer) $_REQUEST['id'];
                $hoy = getDate();
                $sesion = new SESION_Model($_SESSION['login'], '','','','','','','');
                $nombreTabla = $sesion->ConsultarNombreTabla($tabla);
                new SESION_Insertar($nombreTabla,$tabla,'SESION_Controller.php');
            } else {
                $hoy = getDate();
                $horaFin = $hoy['hours'].":".$hoy['minutes'];
                $sesion = new SESION_Model($_SESSION['login'], '', $_REQUEST['idTabla'], $_REQUEST['comentarioSesion'], '', $_REQUEST['fechaSesion'], $_REQUEST['horaInicio'], $horaFin);
                $respuesta = $sesion->Insertar();
                new Mensaje($respuesta, 'SESION_Controller.php');
            }
        }
        break;


    case $strings['Consultar']:
        if (!tienePermisos('SESION_Consultar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            if (!isset($_REQUEST['fechaSesion'])) {
                new SESION_Consultar();
            } else {
                $sesion = new SESION_Model($_SESSION['login'], '', '', '', '', $_REQUEST['fechaSesion'], '', '');
                $datos = $sesion->Consultar();
                new SESION_Consulta($datos, 'SESION_Controller.php');
            }
        }
        break;

    case $strings['Modificar']:
        if (!tienePermisos('SESION_Editar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            if (!isset($_REQUEST['comentarioSesion'])) {
                $sesion = new SESION_Model('', $_REQUEST['idSesion'], '', '', '', '', '', '');
                $datos = $sesion->RellenaDatos();
                new SESION_Editar($datos, '../Views/DEFAULT_Vista.php');
            } else {
                $sesion = new SESION_Model('', $_REQUEST['idSesion'], '', $_REQUEST['comentarioSesion'], '', '', '', '');
                $respuesta = $sesion->Modificar();
                new Mensaje($respuesta, 'SESION_Controller.php');
            }
        }
        break;
    default:
        if (!tienePermisos('SESION_Listar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $sesion = new SESION_Model($_SESSION['login'], '', '', '', '', '', '', '');
            $datos = $sesion->Listar();
            new SESION_Listar($datos, 'SESION_Controller.php');
        }
}
?>
