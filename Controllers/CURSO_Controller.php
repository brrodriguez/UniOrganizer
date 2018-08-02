<?php

//Controlador para la gestión de asignaturas
include '../Models/CURSO_Model.php';
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

function get_data_form() {
	if (isset($_REQUEST['idCurso'])) {
        $idCurso = $_REQUEST['idCurso'];
    } else {
        $idCurso = "";
    }
	
    if (isset($_REQUEST['nombreCurso'])) {
        $nombreCurso = $_REQUEST['nombreCurso'];
    } else {
        $nombreCurso = "";
    }

    if (isset($_REQUEST['descripcionCurso'])) {
        $descripcionCurso = $_REQUEST['descripcionCurso'];
    } else {
        $descripcionCurso = "";
    }

    if (isset($_REQUEST['idCalendario'])) {
        $idCalendario = $_REQUEST['idCalendario'];
    } else {
        $idCalendario = "";
    }

    $curso = new CURSO_Model($idCurso, $nombreCurso, $descripcionCurso, $idCalendario);
    return $curso;
}

if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}

switch ($_REQUEST['accion']) { //Actúa según la acción elegida
    case 'vistainsertar':
      
        if (!tienePermisos('CURSO_ADD')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			$idCalendario = ObtenerCalendario($_SESSION['login']);
            require_once '../Views/CURSO_ADD_Vista.php';
            $datos = "";
            new CURSO_ADD($datos, '../Controllers/CURSO_Controller.php', $idCalendario );
        }
        break;

    case 'ver':
        
        if (!tienePermisos('CURSO_SHOWCURRENT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos['curso'] = $curso->obtenerCursoDetalle($_REQUEST['id']);
            $datos['asignaturas'] = $curso->obtenerRelacion_CursoAsignaturas($_REQUEST['id']);

            require_once '../Views/CURSO_SHOWCURRENT_Vista.php';
            new CURSO_ShowCurrent($datos, '../Controllers/CURSO_Controller.php');
        }
        break;

    case 'frmasignar':

        if (!tienePermisos('CURSO_ASIGN')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
		} else {
			require_once '../Views/CURSO_ASIGN_Vista.php';
			$curso = get_data_form();
			$asignaturas = new ASIGNATURA_Model("", "", "");
			$asig = $asignaturas->Listar();
			$datos['selectasignaturas'] = "";
			foreach ($asig as &$valor) {
				$datos['selectasignaturas'] .= "<option>" . $valor['nombreAsignatura'] . "</option>";
			}
            $otros['curso'] = $curso->obtenerCursoDetalle($_REQUEST['id']);
            $otros['asignaturas'] = $curso->obtenerRelacion_CursoAsignaturas($_REQUEST['id']);
        
			new CURSO_ASIGN($otros, $datos, '../Controllers/CURSO_Controller.php');
		}
        break;

    case 'asignar':

        //Recorremos todas las filas de 4 en 4
        $asign_data = $_POST;
        $curso = get_data_form();
        $asign_data_formated = array_chunk($asign_data, 2, false);
        foreach ($asign_data_formated as $key => $value) {
            //Una vez tenemos cada seccion del array
            //Guardamos la asignacion en la bd con sus correspondientes datos de forma que
            // Orden del Array
            // 1 - Nombre de Asignatura
            // 2 - Descripción de Asigntura

            $curso->asignarAsignaturas($_REQUEST['id'], $value);
        }
        echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
        exit(0);
        break;
		
	case 'desasignar':

        if (!tienePermisos('CURSO_ASIGN')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $curso->desasignarAsignatura($_REQUEST['idCurso'], $_REQUEST['idAsignatura']);
            echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
            exit(0);
        }
        break;

    case 'insertar':

        if (!tienePermisos('CURSO_ADD')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $curso->insertarCurso();
            echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
            exit(0);
        }
        break;


    case 'modificar':

        if (!tienePermisos('CURSO_EDIT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos = $curso->obtenerCursoDetalle($_REQUEST['id']);
            require_once '../Views/CURSO_EDIT_Vista.php';
            new CURSO_Edit($datos, '../Views/ASGNATURA_SHOWALL_Vista.php');
        }
        break;

    case 'guardarmod':

        if (!tienePermisos('CURSO_EDIT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos = $curso->modificarCurso($_REQUEST['id']);
            echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
            exit(0);
        }
        break;



    case 'eliminar':

        if (!tienePermisos('CURSO_EDIT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $curso->eliminarCurso($_REQUEST['id']);
            echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
            exit(0);
        }
        break;

    default: 

         if (ConsultarTipoUsuario($_SESSION['login']) != 2) {
            $curso = get_data_form();
            $datos['cursos'] = $curso->obtenerCursos();

            $asignaturas = new ASIGNATURA_Model("", "", "");
            $datos['asignaturas'] = $asignaturas->Listar();

            require_once '../Views/CURSO_SHOWALL_Vista.php';
            new CURSO_Show($datos, '../Views/ASIGNATURA_SHOWALL_Vista.php');
        } else {
            //Si no, cargaría una vista exactamente igual pero solo vería sus cursos asignadas
            $curso = get_data_form();
            $datos['cursos'] = $curso->obtenerCursosUsuario($_SESSION['login']);

            require_once '../Views/CURSO_SHOWALL_Vista.php';
            new CURSO_Show($datos, '../Views/ASIGNATURA_SHOWALL_Vista.php');
        }
}
?>