<?php

//Gestión del acceso, login, selección de idioma
include_once '../Models/USUARIO_Model.php';
include_once '../Views/MENSAJE_Vista2.php';


if (isset($_REQUEST['accion'])) {

    if ($_REQUEST['accion'] == 'Login') {
        $usuario = new USUARIO_Modelo($_REQUEST['username'], $_REQUEST['password'], '', '', '', '', '', '', '', '');
        $respuesta = $usuario->Login(); //Comprueba que se pueda loguear
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
            new Mensaje2($respuesta, '../index.php');
        }

    }
}
?>
       
