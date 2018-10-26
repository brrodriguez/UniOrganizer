<?php

//Controlador para la gestión de cursos
include '../Models/CURSO_Model.php';
include '../Models/ASIGNATURA_Model.php';
include '../Views/MENSAJE_Vista.php';
include_once '../Functions/LibraryFunctions.php';

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
		
	case 'vistaimportar':
      
        if (!tienePermisos('CURSO_IMPORT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {

			$idCalendario = ObtenerCalendario($_SESSION['login']);
            require_once '../Views/CURSO_IMPORT_Vista.php';
			$asignaturas['selectasignaturas'] = "";
			$seleccionadas[] = ""; 
			$datos['asignaturas'] = extraerAsignaturas();
			foreach ($datos['asignaturas'] as &$valor) {
				$asignaturas['selectasignaturas'] .= "<option>" . $valor . "</option>";//Se crea un <option> para cada asignatura extraida
			}
            new CURSO_IMPORT($asignaturas, $seleccionadas, '../Controllers/CURSO_Controller.php', $idCalendario );
        }
        break;	
		
	case 'importar':

        if (!tienePermisos('CURSO_IMPORT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			if($_REQUEST['curso'] === "0") {	
				new Mensaje('No se importó correctamente porque no se seleccionó ningún curso', '../Views/DEFAULT_Vista.php');
			}else{
				if($_REQUEST['curso'] === "1") {
					$curso = get_data_form();
					$curso->insertarCurso();
					$idCurso = obtenerUltimoCurso();
					$primero = extraerCursos(1);
					$examenes1 = extraerExamenesPrimero();	
					foreach ($primero as $key => $value) {
						if(!(obtenerIdAsignatura($value))){//Se comprueba si las asignaturas extraídas ya existen en el sistema y si no se crean
							$asignatura = new ASIGNATURA_Model("", $value, "");
							$asignatura->Insertar();
						}
						$idAsignatura = obtenerIdAsignatura($value);
						$curso->asignarAsignatura($idCurso, $idAsignatura);
						foreach($examenes1 as $examen){
								$idAsig = obtenerIdAsignatura($examen[1]);
								if($idAsig===$idAsignatura){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
									$datos1 = preg_split('/\s/', $examen[2]);
									$datos2 = preg_split('/\s/', $examen[3]);
									$datos3 = preg_split('/\s/', $examen[4]);
									$curso->crearExamenes($idCurso, $idAsignatura, $datos1, $datos2, $datos3);
								}								
						}
					}
				}else{			
					if($_REQUEST['curso'] === "2") {
						$curso = get_data_form();
						$curso->insertarCurso();
						$idCurso = obtenerUltimoCurso();
						$segundo = extraerCursos(2);
						$examenes2 = extraerExamenesSegundo();
						foreach ($segundo as $key => $value) {
							if(!(obtenerIdAsignatura($value))){
								$asignatura = new ASIGNATURA_Model("", $value, "");
								$asignatura->Insertar();
							}
							$idAsignatura = obtenerIdAsignatura($value);
							$curso->asignarAsignatura($idCurso, $idAsignatura);
							foreach($examenes2 as $examen){
								$idAsig = obtenerIdAsignatura($examen[1]);
								if($idAsig===$idAsignatura){
									$datos1 = preg_split('/\s/', $examen[2]);
									$datos2 = preg_split('/\s/', $examen[3]);
									$datos3 = preg_split('/\s/', $examen[4]);
									$curso->crearExamenes($idCurso, $idAsignatura, $datos1, $datos2, $datos3);
								}								
							}	
						}
					}else{
						if($_REQUEST['curso'] === "3") {
							$curso = get_data_form();
							$curso->insertarCurso();
							$idCurso = obtenerUltimoCurso();
							$tercero = extraerCursos(3);
							$examenes3 = extraerExamenesTercero();
							foreach ($tercero as $key => $value) {
								if(!(obtenerIdAsignatura($value))){
									$asignatura = new ASIGNATURA_Model("", $value, "");
									$asignatura->Insertar();
								}
								$idAsignatura = obtenerIdAsignatura($value);
								$curso->asignarAsignatura($idCurso, $idAsignatura);
								foreach($examenes3 as $examen){
								$idAsig = obtenerIdAsignatura($examen[1]);
								if($idAsig===$idAsignatura){
									$datos1 = preg_split('/\s/', $examen[2]);
									$datos2 = preg_split('/\s/', $examen[3]);
									$datos3 = preg_split('/\s/', $examen[4]);
									$curso->crearExamenes($idCurso, $idAsignatura, $datos1, $datos2, $datos3);
								}								
							}	
							}
						}else{
							if($_REQUEST['curso'] === "4") {
								$curso = get_data_form();
								$curso->insertarCurso();
								$idCurso = obtenerUltimoCurso();
								$cuarto = extraerCursos(4);
								$examenes4 = extraerExamenesCuarto();
								foreach ($cuarto as $key => $value) {								
									if(!(obtenerIdAsignatura($value))){
										$asignatura = new ASIGNATURA_Model("", $value, "");
										$asignatura->Insertar();
									}
									$idAsignatura = obtenerIdAsignatura($value);
									$curso->asignarAsignatura($idCurso, $idAsignatura);
									foreach($examenes4 as $examen){
										$idAsig = obtenerIdAsignatura($examen[1]);
										if($idAsig===$idAsignatura){
											$datos1 = preg_split('/\s/', $examen[2]);
											$datos2 = preg_split('/\s/', $examen[3]);
											$datos3 = preg_split('/\s/', $examen[4]);
											$curso->crearExamenes($idCurso, $idAsignatura, $datos1, $datos2, $datos3);
										}								
									}		
								}
							}
						}
					}
				}
			}
            echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
            exit(0);
        }
        break;	

    case 'ver':
        
        if (!tienePermisos('CURSO_SHOW')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos['curso'] = $curso->obtenerCursoDetalle($_REQUEST['id']);
            $datos['asignaturas'] = $curso->obtenerRelacion_CursoAsignaturas($_REQUEST['id']);

            require_once '../Views/CURSO_SHOW_Vista.php';
            new CURSO_SHOW($datos, '../Controllers/CURSO_Controller.php');
        }
        break;

    case 'vistaasignar':

        if (!tienePermisos('CURSO_ASIGN')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
		} else {
			require_once '../Views/CURSO_ASIGN_Vista.php';
			$curso = get_data_form();
			$listaAsignaturas = extraerAsignaturas();
			foreach ($listaAsignaturas as $key => $value) {													
				if(!(obtenerIdAsignatura($value))){//Se comprueba si las asignaturas extraídas ya existen en el sistema y si no se crean
					$asignatura = new ASIGNATURA_Model("", $value, "");
					$asignatura->Insertar();
				}
			}
			$asignatura = new ASIGNATURA_Model("", "", "");
			$asig = $asignatura->Listar();
			$datos['selectasignaturas'] = "";
			foreach ($asig as $valor) {
				$datos['selectasignaturas'] .= "<option value=" . $valor['idAsignatura'] . ">" . $valor['nombreAsignatura'] . "</option>";
			}
            $otros['curso'] = $curso->obtenerCursoDetalle($_REQUEST['id']);
            $otros['asignaturas'] = $curso->obtenerRelacion_CursoAsignaturas($_REQUEST['id']);
        
			new CURSO_ASIGN( $otros, $datos, '../Controllers/CURSO_Controller.php');
		}
        break;

    case 'asignar':

		$examenes1 = extraerExamenesPrimero();	
		$examenes2 = extraerExamenesSegundo();
		$examenes3 = extraerExamenesTercero();
		$examenes4 = extraerExamenesCuarto();
        //Recorremos todas las filas de 1 en 1
        $asign_data = $_POST;
        $curso = get_data_form();
        $asign_data_formated = array_chunk($asign_data, 1, false);
        foreach ($asign_data_formated as $key => $value) {
            //Una vez tenemos cada seccion del array
            //Guardamos la asignacion en la bd con sus correspondientes datos de forma que
            // Orden del Array
            // 0 - Id de Asignatura
            $curso->asignarAsignatura($_REQUEST['idCurso'], $value[0]);
			foreach($examenes1 as $examen){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
				$idAsig = obtenerIdAsignatura($examen[1]);
				if($idAsig===$value[0]){
					$datos1 = preg_split('/\s/', $examen[2]);
					$datos2 = preg_split('/\s/', $examen[3]);
					$datos3 = preg_split('/\s/', $examen[4]);
					$curso->crearExamenes($_REQUEST['idCurso'], $idAsig, $datos1, $datos2, $datos3);
				}								
			}	
			foreach($examenes2 as $examen){
				$idAsig = obtenerIdAsignatura($examen[1]);
				if($idAsig===$value[0]){
					$datos1 = preg_split('/\s/', $examen[2]);
					$datos2 = preg_split('/\s/', $examen[3]);
					$datos3 = preg_split('/\s/', $examen[4]);
					$curso->crearExamenes($_REQUEST['idCurso'], $idAsig, $datos1, $datos2, $datos3);
				}								
			}	
			foreach($examenes3 as $examen){
				$idAsig = obtenerIdAsignatura($examen[1]);
				if($idAsig===$value[0]){
					$datos1 = preg_split('/\s/', $examen[2]);
					$datos2 = preg_split('/\s/', $examen[3]);
					$datos3 = preg_split('/\s/', $examen[4]);
					$curso->crearExamenes($_REQUEST['idCurso'], $idAsig, $datos1, $datos2, $datos3);
				}								
			}
			foreach($examenes4 as $examen){
				$idAsig = obtenerIdAsignatura($examen[1]);
				if($idAsig===$value[0]){
					$datos1 = preg_split('/\s/', $examen[2]);
					$datos2 = preg_split('/\s/', $examen[3]);
					$datos3 = preg_split('/\s/', $examen[4]);
					$curso->crearExamenes($_REQUEST['idCurso'], $idAsig, $datos1, $datos2, $datos3);
				}								
			}			
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


    case 'vistamodificar':

        if (!tienePermisos('CURSO_EDIT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos = $curso->obtenerCursoDetalle($_REQUEST['id']);
            require_once '../Views/CURSO_EDIT_Vista.php';
            new CURSO_EDIT($datos, '../Controllers/CURSO_Controller.php');
        }
        break;

    case 'modificar':

        if (!tienePermisos('CURSO_EDIT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos = $curso->modificarCurso($_REQUEST['id']);
            echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
            exit(0);
        }
        break;

	case 'vistaeliminar':

        if (!tienePermisos('CURSO_DELETE')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos = $curso->obtenerCursoDetalle($_REQUEST['id']);
            require_once '../Views/CURSO_DELETE_Vista.php';
            new CURSO_DELETE($datos, '../Controllers/CURSO_Controller.php');
        }
        break;

    case 'eliminar':

        if (!tienePermisos('CURSO_DELETE')) {
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
			//Carga una vista con todos los cursos al ser administrador
			$curso = new CURSO_Model("", "", "", "");
            $datos = $curso->obtenerCursos();

            require_once '../Views/CURSO_SHOWALL_Vista.php';
            new CURSO_SHOWALL($datos, '../Controllers/CURSO_Controller.php');
        } else {
            //Si no, cargaría una vista exactamente igual pero solo vería sus cursos
            $curso = get_data_form();
			$curso = new CURSO_Model("", "", "", "");
			$id = ObtenerCalendario($_SESSION['login']);
            $datos = $curso->obtenerCursosUsuario($id);

            require_once '../Views/CURSO_SHOWALL_Vista.php';
            new CURSO_SHOWALL($datos, '../Controllers/CURSO_Controller.php');
        }
}
?>