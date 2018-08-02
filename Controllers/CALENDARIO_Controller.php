<?php

//Controlador para la gestión de actividades grupales
include '../Models/ACTIVIDAD_GRUPAL_Model.php';
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

    //Atributos de actividad grupal

    if (!isset($_REQUEST['idActividadGrupal'])) {
        $idActividadGrupal = '';
    } else {
        $idActividadGrupal = $_REQUEST['idActividadGrupal'];
    }

    $nombreActividadGrupal = $_REQUEST['nombreActividadGrupal'];
    $descripcionActividadGrupal = $_REQUEST['descripcionActividadGrupal'];
    $numPlazasActividadGrupal = $_REQUEST['numPlazasActividadGrupal'];
    $diaActividadGrupal = $_REQUEST['diaActividadGrupal'];
    $horaInicioActividadGrupal = $_REQUEST['horaInicioActividadGrupal'];
    $horaFinActividadGrupal = $_REQUEST['horaFinActividadGrupal'];
    $fechaInicioActividadGrupal = $_REQUEST['fechaInicioActividadGrupal'];
    $fechaFinActividadGrupal = $_REQUEST['fechaFinActividadGrupal'];
    $username = $_REQUEST['username'];
    $idInstalacion = $_REQUEST['idInstalacion'];

    $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($idActividadGrupal, $nombreActividadGrupal, $descripcionActividadGrupal, $numPlazasActividadGrupal, $diaActividadGrupal, $horaInicioActividadGrupal, $horaFinActividadGrupal, $fechaInicioActividadGrupal, $fechaFinActividadGrupal, $username, $idInstalacion);

    return $actividadGrupal;
}

if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}


Switch ($_REQUEST['accion']) { //Actúa según la acción elegida
    case $strings['Insertar']:

        if (!isset($_REQUEST['nombreActividadGrupal'])) { //Si no se ha introducido ningun valor, mostramos la vista con el formulario
            $entrenadores = ListarEntrenadores();
            $instalaciones = ListarInstalaciones();
            new ACTIVIDAD_GRUPAL_Insertar($entrenadores, $instalaciones);
        } else {
            //Recogemos los datos del formulario
            $actividadGrupal = get_data_form();
            $respuesta = $actividadGrupal->Insertar();
            new Mensaje($respuesta, '../Controllers/ACTIVIDAD_GRUPAL_Controller.php');
        }break;

    case $strings['Modificar']:


        if (!tienePermisos('ACTIVIDAD_GRUPAL_Modificar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            if (!isset($_REQUEST['nombreActividadGrupal'])) {
                $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($_REQUEST['idActividadGrupal'], '', '', '', '', '', '', '', '', '', '');
                $datos = $actividadGrupal->RellenaDatos();
                $entrenadores = ListarEntrenadores();
                $instalaciones = ListarInstalaciones();
                new ACTIVIDAD_GRUPAL_Modificar($datos, '../Views/DEFAULT_Vista.php', $entrenadores, $instalaciones);
            } else {
                $idActividadGrupal = $_REQUEST['idActividadGrupal'];
                $actividadGrupal = get_data_form();
                $respuesta = $actividadGrupal->Modificar();
                new Mensaje($respuesta, '../Controllers/ACTIVIDAD_GRUPAL_Controller.php');
            }
        }
        break;



    case $strings['Borrar']:

        if (!isset($_REQUEST['idActividadGrupal'])) {
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($_REQUEST['idActividadGrupal'], '', '', '', '', '', '', '', '', '', '');
            $valores = $actividadGrupal->RellenaDatos();
            if (!tienePermisos('ACTIVIDAD_GRUPAL_Borrar')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
            } else {
                new ACTIVIDAD_GRUPAL_Borrar($valores, 'ACTIVIDAD_GRUPAL_Controller.php');
            }
        } else {
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($_REQUEST['idActividadGrupal'], '', '', '', '', '', '', '', '', '', '');
            $respuesta = $actividadGrupal->Borrar();
            new Mensaje($respuesta, '../Controllers/ACTIVIDAD_GRUPAL_Controller.php');
        }
        break;

//
//    case $strings['Consultar']:
//
//        if ((!isset($_REQUEST['nombreActividadGrupal'])) || (!isset($_REQUEST['diaActividadGrupal'])) || (!isset($_REQUEST['horaInicioActividadGrupal'])) || (!isset($_REQUEST['horaFinActividadGrupal'])) || (!isset($_REQUEST['fechaInicioActividadGrupal'])) || (!isset($_REQUEST['fechaFinActividadGrupal'])) ||  (!isset($_REQUEST['username'])) || (!isset($_REQUEST['idInstalacion']))) {
//
//            if (!tienePermisos('ACTIVIDAD_GRUPAL_Consultar')) {
//                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
//            }
//            $entrenadores = ListarEntrenadores();
//            $instalaciones = ListarInstalaciones();
//            new ACTIVIDAD_GRUPAL_Consultar('../Controllers/ACTIVIDAD_GRUPAL_Controller.php',$entrenadores, $instalaciones);
//       } 
//        else {
//            
//            
//            
//   
//
//         
//            if (!isset($_REQUEST['nombreActividadGrupal'])) {
//                $nombreActividadGrupal = '';
//            } else {
//                $nombreActividadGrupal = $_REQUEST['nombreActividadGrupal'];
//            }
//  
//            if (!isset($_REQUEST['$diaActividadGrupal'])) {
//                $diaActividadGrupal = '';
//            } else {
//                $diaActividadGrupal = $_REQUEST['$diaActividadGrupal'];
//            }
//            
//            if (!isset($_REQUEST['$horaInicioActividadGrupal'])) {
//                $horaInicioActividadGrupal = '';
//            } else {
//                $horaInicioActividadGrupal = $_REQUEST['$horaInicioActividadGrupal'];
//            }
//            
//             if (!isset($_REQUEST['$horaFinActividadGrupal'])) {
//                $horaFinActividadGrupal = '';
//            } else {
//                $horaFinActividadGrupal = $_REQUEST['$horaFinActividadGrupal'];
//            }
//            
//            if (!isset($_REQUEST['$fechaInicioActividadGrupal'])) {
//                $fechaInicioActividadGrupal = '';
//            } else {
//                $fechaInicioActividadGrupal = $_REQUEST['$fechaInicioActividadGrupal'];
//            }
//            
//             if (!isset($_REQUEST['$fechaFinActividadGrupal'])) {
//                $fechaFinActividadGrupal = '';
//            } else {
//                $fechaFinActividadGrupal = $_REQUEST['$fechaFinActividadGrupal'];
//            }
//            
//            if (!isset($_REQUEST['username'])) {
//                $username = '';
//            } else {
//                $username = $_REQUEST['username'];
//            }
//
//            if (!isset($_REQUEST['idInstalacion'])) {
//                $idInstalacion = '';
//            } else {
//                $idInstalacion = $_REQUEST['idInstalacion'];
//            }
//
//        $actividadGrupal = new ACTIVIDAD_GRUPAL_Model('', $nombreActividadGrupal, '', '', $diaActividadGrupal, $horaInicioActividadGrupal, $horaFinActividadGrupal, $fechaInicioActividadGrupal, $fechaFinActividadGrupal, $username, $idInstalacion);
//        $datos = $actividadGrupal->Consultar();
//        new ACTIVIDAD_GRUPAL_Listar($datos, '../Controllers/ACTIVIDAD_GRUPAL_Controller.php');
//        }
//        break;


    case $strings['Ver']:

        if (isset($_REQUEST['idActividadGrupal'])) {
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($_REQUEST['idActividadGrupal'], '', '', '', '', '', '', '', '', '', '');
            $datos = $actividadGrupal->RellenaDatos();
            if (!tienePermisos('ACTIVIDAD_GRUPAL_VerDetalle')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
            } else {
                new ACTIVIDAD_GRUPAL_VerDetalle($datos, '../Controllers/ACTIVIDAD_GRUPAL_Controller.php');
            }
        }

        break;


    case $strings['Ver1']:

        if (isset($_REQUEST['idActividadGrupal'])) {
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($_REQUEST['idActividadGrupal'], '', '', '', '', '', '', '', '', '', '');
            $datos = $actividadGrupal->RellenaDatos();
            if (!tienePermisos('ACTIVIDAD_GRUPAL_VerDetalle')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
            } else {
                new ACTIVIDAD_GRUPAL_VerDetalle($datos, '../Controllers/DEPORTISTA_Controller.php?userName=' . $_SESSION['login'] . '&accion=' . $strings['MisActividades']);
            }
        }

        break;


    case $strings['MisActividades']:

        if (isset($_REQUEST['userName'])) {
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model('', '', '', '', '', '', '', '', '', $_REQUEST['userName'], '');
            $datos = $actividadGrupal->ConsultarActividadesUser();
            if (!tienePermisos('ACTIVIDAD_GRUPAL_Listar_User')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
            } else {
                new ACTIVIDAD_GRUPAL_Listar_User($datos, '../Views/DEFAULT_Vista.php');
            }
        }

        break;



    case $strings['Asignar']:

        if (isset($_REQUEST['idActividadGrupal'])) {
            $numPlazasActividadGrupal = ConsultarNumPlazas($_REQUEST['idActividadGrupal']);
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($_REQUEST['idActividadGrupal'], '', '', $numPlazasActividadGrupal, '', '', '', '', '', $_REQUEST['userName'], '');
            $respuesta = $actividadGrupal->SolicitarInscripcion();
            new Mensaje($respuesta, '../Controllers/ACTIVIDAD_GRUPAL_Controller.php');
        }

        break;


    case $strings['VerInscritos']:

        if (isset($_REQUEST['idActividadGrupal'])) {
            $numPlazasActividadGrupal = ConsultarNumPlazas($_REQUEST['idActividadGrupal']);
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model($_REQUEST['idActividadGrupal'], '', '', '', '', '', '', '', '', '', '');
            $datos = $actividadGrupal->ConsultarDeportistasActividad();
            if (!tienePermisos('ACTIVIDAD_GRUPAL_LISTAR_USERS')) {
                new Mensaje('No tienes los permisos necesarios', '../Controllers/ACTIVIDAD_GRUPAL.php');
            } else {
                new ACTIVIDAD_GRUPAL_LISTAR_USERS($datos, '../Controllers/ACTIVIDAD_GRUPAL.php');
            }
        }

        break;




    default: //Por defecto se realiza el show all
        if (!tienePermisos('ACTIVIDAD_GRUPAL_Listar')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $actividadGrupal = new ACTIVIDAD_GRUPAL_Model('', '', '', '', '', '', '', '', '', '', '');
            $datos = $actividadGrupal->Listar();
            new ACTIVIDAD_GRUPAL_Listar($datos, '../Views/DEFAULT_Vista.php');
        }
}
?>
