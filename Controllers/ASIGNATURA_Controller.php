<?php
//Controlador para la gestión de ejercicios
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
	
	if( isset($_REQUEST['descripcionAsignatura']) )
	{
		$descripcionAsignatura =$_REQUEST['descripcionAsignatura'];
	}else{ 
		$descripcionAsignatura = ""; 
	}
	
	$asignatura = new ASIGNATURA_Model( $idAsignatura, $nombreAsignatura, $descripcionAsignatura);
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




    case 'modificar':
		if (!tienePermisos('ASIGNATURA_EDIT')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
				$asignatura = get_data_form();
				$datos = $asignatura->VerDetalle( $_REQUEST['id'] );
				require_once '../Views/ASIGNATURA_EDIT_Vista.php';
				new ASIGNATURA_EDIT($datos, "../Controllers/ASIGNATURA_Controller.php");
		}
    break;
	
	case 'guardarmod':
		if (!tienePermisos('ASIGNATURA_EDIT')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
				$asignatura = get_data_form();
				$datos = $asignatura->Modificar( $_REQUEST['id'] );
				echo '<script> location.replace("../Controllers/ASIGNATURA_Controller.php"); </script>';
				exit(0);
		}
    break;


    case 'eliminar':
		if (!tienePermisos('ASIGNATURA_DELETE')) {
					new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
					$asignatura = get_data_form();
					$datos = $asignatura->Borrar( $_REQUEST['id'] );
					$datos = $asignatura->Listar();
					require_once '../Views/ASIGNATURA_SHOWALL_Vista.php';
					new ASIGNATURA_SHOW($datos, "../Controllers/ASIGNATURA_Controller.php");
		}
    break;
    
    default: //Por defecto se realiza el show all
      
	    $asignatura = get_data_form();
        $datos = $asignatura->Listar();
	
        if (!tienePermisos('ASIGNATURA_SHOW')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			require_once '../Views/ASIGNATURA_SHOWALL_Vista.php';
            new ASIGNATURA_SHOW($datos, '../Views/ASIGNATURA_SHOWALL_Vista.php');
        }
}


?>