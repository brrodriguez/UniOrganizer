<?php

include '../Models/ALERTA_Model.php';
include '../Views/MENSAJE_Vista.php';


if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include_once '../Functions/LibraryFunctions.php';
include '../Views/header.php';
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';

$pags = generarIncludes(); //Realizamos los includes de las páginas a las que tiene acceso
for ($z = 0; $z < count($pags); $z++) {
    include $pags[$z];
}
if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}

//Este get data form se usa para obtener los datos en el caso de una inserción.
//En el caso de la inserción el username y usuario van a ser el mismo.
function get_data_form() {
    $idAlerta = $_REQUEST['idAlerta'];
    $asuntoAlerta = $_REQUEST['asuntoAlerta'];
    $descripcionAlerta = $_REQUEST['descripcionAlerta'];


    $alerta = new ALERTA_Model($idAlerta, $asuntoAlerta, $descripcionAlerta);
    return $alerta;
}

switch ($_REQUEST['accion']) {
    case $strings['Crear']:

        case $strings['Crear']:
        if (!tienePermisos('ALERTA_Insertar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            if (!isset($_REQUEST['username'])) {
				
                $alerta = new ALERTA_Model('', '', '');                 
                new ALERTA_Insertar( '../Controllers/ALERTA_Controller.php');
                

            } else {
				$fecha = $_REQUEST['fecha'];
				$menos = '-';
				$dias = $_REQUEST['dias'];
				$day = ' day';
				$dia = $menos . $dias . $day;
				$nuevafecha = strtotime ( $dia , strtotime ( $fecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				$alerta = new ALERTA_Model( '', $_REQUEST['asuntoAlerta'], $_REQUEST['descripcionAlerta']);
                $respuesta = $alerta->Insertar($_REQUEST['fecha'], $_REQUEST['hora']);
				$aviso1 = "AVISO: ";
				$aviso2 = " dias para ";
				$asunto = $aviso1 . $dias . $aviso2;
                $alerta2 = new ALERTA_Model( '', $asunto, $_REQUEST['descripcionAlerta']);
				$alerta2->Insertar($nuevafecha, $_REQUEST['hora']);
                new Mensaje($respuesta, '../Controllers/ALERTA_Controller.php');
            }
        }

    case $strings['Borrar']:

        if (!tienePermisos('ALERTA_Borrar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			if (!isset($_REQUEST['username'])) {
				
                $idAlerta = $_REQUEST['idAlerta'];
                $alerta = new ALERTA_Model($idAlerta, '', '');
                $datos = $alerta->Ver();               
                new ALERTA_Borrar($datos, '../Controllers/ALERTA_Controller.php');
                

            } else {
                $alerta = new ALERTA_Model($_REQUEST['idAlerta'], '', '');
				$respuesta = $alerta->Borrar();
				new Mensaje($respuesta, '../Controllers/ALERTA_Controller.php');
            }
            
        }
        break;

    //En el caso de que quiera consultar una alerta en concreto creo la alerta solo con el id que va a venir de la vista,
    //llamo a la funcion que obtiene los datos sobre esa alerta y creo una vista showcurrent mostrando los datos y con el controlador de las alertas.
    case $strings['Ver']:
		
		if (!tienePermisos('ALERTA_Ver')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			if (!isset($_REQUEST['username'])) {
				
                $idAlerta = $_REQUEST['idAlerta'];
                $alerta = new ALERTA_Model($idAlerta, '', '');
                $datos = $alerta->Ver();               
                new ALERTA_Ver($datos, '../Controllers/ALERTA_Controller.php');
                

            } else {
                $alerta = new ALERTA_Model($_REQUEST['idAlerta'], '', '');
				$respuesta = $alerta->Borrar();
				new Mensaje($respuesta, '../Controllers/ALERTA_Controller.php');
            }
            
        }
        if (!tienePermisos('ALERTA_Seleccionar')) {
            new Mensaje('No tienes los permisos necesarios', '../Controllers/ALERTA_Controller.php');
        } else {
            if (!isset($_REQUEST['idAlerta'])) {
                
            } else {
                if(!isset($_REQUEST['usuario']))
                {
                    $_REQUEST['usuario'] = "Otro";
                }
                if($_REQUEST['usuario']=="envio")
                {
                $idAlerta = $_REQUEST['idAlerta'];
                $alerta = new ALERTA_Model($idAlerta, '', '');
                $resultado = $alerta->Ver();
                new ALERTA_Seleccionar($resultado, '../Controllers/ALERTA_Controller.php');
                }
                else
                {
                $idAlerta = $_REQUEST['idAlerta'];
                $alerta = new ALERTA_Model($idAlerta, '', '');
                $resultado = $alerta->Ver();
                new ALERTA_Seleccionar($resultado, '../Controllers/ALERTA_Controller.php');
                }
            }
        }
        break;

    //Por defecto se realiza un show all de las alertas a las que tiene acceso el usuario.
    default:

        if (!tienePermisos('ALERTA_Listar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			$tipoUsuario = ConsultarTipoUsuario($_SESSION['login']);
			if($tipoUsuario == 1){
				
				$alerta = new ALERTA_Model('', '', '');
				$datos = $alerta->ListarTodo();				
				new ALERTA_Listar($datos, '../Controllers/ALERTA_Controller.php');
				
			}else{ 
			
				$idCalendario = ObtenerCalendario($_SESSION['login']);
				$alerta = new ALERTA_Model('', '', '');
				$datos = $alerta->Listar($idCalendario);				
				new ALERTA_Listar($datos, '../Controllers/ALERTA_Controller.php');
			}
			
        }
}
?>