<?php
//Controlador para la gestión de asignaturas
include '../Models/ASIGNATURA_Model.php';
include '../Views/MENSAJE_Vista.php';



if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include '../Views/header.php';
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';


$pags = generarIncludes(); //Realizamos los includes de las páginas a las que tiene acceso
for ($z = 0; $z < count($pags); $z++) {
    include $pags[$z];
}

function get_data_form()
{
	if( isset($_REQUEST['idAsignatura']) )
	{
		$idAsignatura =$_REQUEST['idAsignatura'];
	}else{ 
		$idAsignatura = ""; 
	}
	
	if( isset($_REQUEST['nombreAsignatura']) )
	{
		$nombreAsignatura = $_REQUEST['nombreAsignatura'];
	}else{
		$nombreAsignatura = "";
	}
	
	$asignatura = new ASIGNATURA_Model( $idAsignatura, $nombreAsignatura);
	return $asignatura;
}

if ( !isset($_REQUEST['accion']) )
{
    $_REQUEST['accion'] = '';
}

switch ($_REQUEST['accion']) { //Actúa según la acción elegida
    
	case 'vistainsertar':
		if (!tienePermisos('ASIGNATURA_ADD')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
				require_once '../Views/ASIGNATURA_ADD_Vista.php';
				$datos = "";
				new ASIGNATURA_ADD($datos, "../Controllers/ASIGNATURA_Controller.php");
		}
	break;
	
	case 'insertar':
		if (!tienePermisos('ASIGNATURA_ADD')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
				$asignatura = get_data_form();
				$asignatura->Insertar();
				echo '<script> location.replace("../Controllers/ASIGNATURA_Controller.php"); </script>';
				exit(0);
		}
    break;
	
	case 'vistaeliminar':
		if (!tienePermisos('ASIGNATURA_DELETE')) {
					new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
					$asignatura = get_data_form();
					$datos = $asignatura->Ver( $_REQUEST['id'] );
					require_once '../Views/ASIGNATURA_DELETE_Vista.php';
					new ASIGNATURA_DELETE($datos, "../Controllers/ASIGNATURA_Controller.php");
		}
    break;

    case 'eliminar':
		if (!tienePermisos('ASIGNATURA_DELETE')) {
					new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
					$asignatura = get_data_form();
					$asignatura->Borrar( $_REQUEST['id'] );
					$datos = $asignatura->Listar();
					$tipoUsuario = ConsultarTipoUsuario($_SESSION['login']);
					require_once '../Views/ASIGNATURA_SHOWALL_Vista.php';
					new ASIGNATURA_SHOWALL($datos, $tipoUsuario, "../Controllers/ASIGNATURA_Controller.php");
		}
    break;
    
    default: //Por defecto se realiza el show all
      
	    $asignatura = get_data_form();
        $datos = $asignatura->Listar();
		$tipoUsuario = ConsultarTipoUsuarioLogin();
	
        if (!tienePermisos('ASIGNATURA_SHOWALL')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			require_once '../Views/ASIGNATURA_SHOWALL_Vista.php';
            new ASIGNATURA_SHOWALL($datos, $tipoUsuario,  '../Views/ASIGNATURA_SHOWALL_Vista.php');
        }
}


?>