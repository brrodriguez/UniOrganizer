<?php
//Controlador para gestion del registro
include_once '../Models/USUARIO_Model.php';
include_once '../Views/MENSAJE_Vista2.php';

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
            $usuario->Insertar();
			$usuario->sendEmail($_REQUEST['email'], $_REQUEST['username'], $_REQUEST['password']);
			$respuesta2 = $usuario->Login(); //Comprueba que se pueda loguear
			if ($respuesta == 'true') {
				if(session_status() === PHP_SESSION_NONE){//Comprueba si ya hay una sesión iniciada, si no la hay la inicia
					session_start();
				}
				$calendarioHoras = $usuario->listarCalendarioHoras();
				$horas = $usuario->listarHoras();
				$asignaturas = $usuario->listarAsignaturas();
				$cursos = $usuario->listarCursos();
				$alertas = $usuario->listarAlertas();
				$misCursos = $usuario->listarMisCursos();
				
				$_SESSION['IDIOMA'] = $_REQUEST['IDIOMA']; //Establece el idioma de la sesión
				$_SESSION['login'] = $usuario->username; //Establece el login de la sesión
				$_SESSION['pass'] = $usuario->password; //Establece la pass de la sesión
				$_SESSION['calendario'] = $usuario->obtenerCalendario(); //Establece el calendario de la sesión
				$_SESSION['sesion'] = 0;
				
				if (isset($_POST["wk"])){//Comprueba si se pasa el valor de la semana para proceder a cargar los datos
					$semana = (string)$_POST["wk"];
					$contador = $_POST["contador"];		
				}else{//Si no utiliza como la fecha actual para cargar los datos
					$array_date = getDate();
					$date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
					$semana = date('W', strtotime($date));
					$contador = 0;
				}
				if (isset($_POST["curso"])){//Comprueba el curso selecionado para cargar los datos relacionados
					if($_POST["curso"]== -1){
						$_SESSION['curso'] = $_POST["curso"];
					}else{
						if($_POST["curso"]== 0){
							if($_SESSION['curso']!=-1){
								$calendarioHoras = $usuario->listarCalendarioHorasPorCurso($_SESSION['curso']);
							}					
						}else{
							$_SESSION['curso'] = $_POST["curso"];
							$calendarioHoras = $usuario->listarCalendarioHorasPorCurso($_SESSION['curso']);
						}	
					}
				}
				//Se obtienen los eventos para cada día de la semana especificada
				$_SESSION['Lunes'] = $usuario->get_day($calendarioHoras,$horas,$asignaturas,$cursos,$alertas,"Monday", $semana);
				$_SESSION['Martes'] = $usuario->get_day($calendarioHoras,$horas,$asignaturas,$cursos,$alertas,"Tuesday", $semana);
				$_SESSION['Miercoles'] = $usuario->get_day($calendarioHoras,$horas,$asignaturas,$cursos,$alertas,"Wednesday", $semana);
				$_SESSION['Jueves'] = $usuario->get_day($calendarioHoras,$horas,$asignaturas,$cursos,$alertas,"Thursday", $semana);
				$_SESSION['Viernes'] = $usuario->get_day($calendarioHoras,$horas,$asignaturas,$cursos,$alertas,"Friday", $semana);
				$_SESSION['Sabado'] = $usuario->get_day($calendarioHoras,$horas,$asignaturas,$cursos,$alertas,"Saturday", $semana);
				$_SESSION['Domingo'] = $usuario->get_day($calendarioHoras,$horas,$asignaturas,$cursos,$alertas,"Sunday", $semana);
				$_SESSION['semana'] = $semana;//Establece la semana que mostrará el calendario
				$_SESSION['contador'] = $contador;
				$_SESSION['misCursos'] = $misCursos;//Lista de los cursos del usuario actual
				

				header('Location:../index.php');
				
			} else {
				$_SESSION['IDIOMA'] = $_REQUEST['IDIOMA'];
				new Mensaje2($respuesta2, '../index.php');
			}
        } else {
            new Mensaje2($respuesta, '../index.php');
        }
    }
}
?>
