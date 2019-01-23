<?php

//LIBRERIA DE FUNCIONES
//
//Evalúa si el usuario se ha autenticado
function IsAuthenticated() {
    session_start();
    if (!isset($_SESSION['login'])) {
        return false;
    } else {

        return true;
    }
}

function saltoLinea($str) {
  return str_replace(array("\r\n", "\r", "\n"), "<br/>", $str);
}  

//Añade los roles al desplegable de tipos
function AñadirTipos($array) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT nombreRol from ROL';
    $result = $mysqli->query($sql);
    $str = array();
    while ($tipo = $result->fetch_array()) {
        array_push($str, $tipo['nombreRol']);
    }

    $añadido = array(
        'type' => 'select',
        'name' => 'tipoUsuario',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );
    $array[count($array)] = $añadido;
    return $array;
}

//Añade al formulario de definicion las entradas correspondientes a las paginas disponibles
function AñadirPaginas($array) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT nombrePagina from PAGINA';
    $result = $mysqli->query($sql);
    while ($tipo = $result->fetch_array()) {
        $array[count($array)] = array(
            'type' => 'checkbox',
            'name' => 'funcionalidad_paginas[]',
            'value' => $tipo['nombrePagina'],
            'size' => 20,
            'required' => true,
            'pattern' => '',
            'validation' => '',
            'readonly' => false);
    }
    return $array;
}

//Añade al array de definición de formulario las entradas correspondientes a las funcionalidades añadidas
function AñadirFunciones($array) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT nombreFuncionalidad from FUNCIONALIDAD';
    $result = $mysqli->query($sql);
    while ($tipo = $result->fetch_array()) {
        $array[count($array)] = array(
            'type' => 'checkbox',
            'name' => 'rol_funcionalidades[]',
            'value' => $tipo['nombreFuncionalidad'],
            'size' => 20,
            'required' => true,
            'pattern' => '',
            'validation' => '',
            'readonly' => false);
    }
    return $array;
}

//Devuelve el nombre de una funcionalidad a partir de su id
function ConsultarNombreFuncionalidad($idFuncionalidad) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT nombreFuncionalidad FROM FUNCIONALIDAD WHERE idFuncionalidad='" . $idFuncionalidad . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['nombreFuncionalidad'];
}
 
//Devuelve el nombre de un rol a partir de su id
function ConsultarIDRol($nombreRol) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT idRol FROM ROL WHERE nombreRol='" . $nombreRol . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['idRol'];
}
 
//Devuelve el ID de un curso a partir de su nombre
function ConsultarIDCurso($nombreCurso) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT idCurso FROM Curso WHERE nombreCurso='" . $nombreCurso . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['idCurso'];
}
 
//Devuelve el id de un rol a partir del username del usuario
function ConsultarTipoUsuario($username) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT tipoUsuario FROM USUARIO WHERE USUARIO.username='" . $username . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['tipoUsuario'];
}
 
//Devuelve el id de un rol a partir del username del usuario
function ConsultarTipoUsuarioLogin() {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $sql = "SELECT tipoUsuario FROM USUARIO WHERE USUARIO.username='" . $_SESSION['login'] . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['tipoUsuario'];
}

//Añade a la pagina default los enlaces correspondientes a las funcionalidades
function añadirFuncionalidades($NOM) {
    include '../Locates/Strings_' . $NOM['IDIOMA'] . '.php';
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $rol = "SELECT tipoUsuario FROM USUARIO  WHERE username='" . $NOM['login'] . "'";
    $sql = "SELECT DISTINCT categoriaFuncionalidad FROM FUNCIONALIDAD, FUNCIONALIDAD_ROL WHERE FUNCIONALIDAD_ROL.idFuncionalidad = FUNCIONALIDAD.idFuncionalidad AND FUNCIONALIDAD_ROL.idRol=(" . $rol . ")";
    if (!($resultado = $mysqli->query($sql))) {
        echo 'Error en la consulta sobre la base de datos';
    } else {
        while ($fila = $resultado->fetch_array()) {
            $funcionalidad = $fila['categoriaFuncionalidad'];

            switch ($funcionalidad) {

                case "Gestion Usuarios":
					if(ConsultarTipoUsuarioLogin()==1){
                        ?><li><a style="font-size:15px;" href="../Controllers/USUARIO_Controller.php"><?php echo $strings['Gestión de Usuarios']; ?></a></li> <?php
					}
                    break;

                case "Gestion Cursos":
                    ?><li><a style="font-size:15px;" href="../Controllers/CURSO_Controller.php"><?php echo $strings['Gestión de Cursos']; ?></a></li> <?php
                    break;			
					
                case "Gestion Eventos":
                    ?><li><a style="font-size:15px;" href="../Controllers/ALERTA_Controller.php"><?php echo $strings['Gestión de Eventos']; ?></a></li> <?php
                    break;
				
				case "Gestion Asignaturas":
                    ?><li><a style="font-size:15px;" href="../Controllers/ASIGNATURA_Controller.php"><?php echo $strings['Gestión de Asignaturas']; ?></a></li> <?php
                    break;

                default:
                    break;
            }
        }
    }
}
 
//Revisa si tiene permiso al comprobar si se ha incluido la clase a la que se quiere acceder
function tienePermisos($string) {
    return class_exists($string);
}
 
//Genera los includes correspondientes a las paginas a las que se tiene acceso
function generarIncludes() {
    $toret = array();
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT DISTINCT pagina.linkPagina FROM Pagina, funcionalidad_pagina, funcionalidad_rol, usuario_rol WHERE pagina.idPagina=funcionalidad_pagina.idPagina AND funcionalidad_pagina.idFuncionalidad=funcionalidad_rol.idFuncionalidad AND funcionalidad_rol.idRol=usuario_rol.idRol AND usuario_rol.username ='" . $_SESSION['login'] . "'";
    if (!($resultado = $mysqli->query($sql))) {
        echo 'Error en la consulta sobre la base de datos';
    } else {
        while ($tupla = $resultado->fetch_array()) {
            array_push($toret, $tupla['linkPagina']);
        }
    }
    return $toret;
}

//Funcionalidades en funcion de los permisos

function showNavbar() {

    if (!isset($_SESSION)) {
		
        echo '<br><br><li role="presentation" class="active"><a href="../Functions/Conectar.php" class="m1">Iniciar Sesion</a></li>';
		
		echo '<br><br><li role="presentation" class="active"><a href="../Functions/Registrar.php" class="m1">Registrar</a></li>';
    } else {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        añadirFuncionalidades($_SESSION);
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $strings['Cuenta'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="../Controllers/USUARIO_Controller.php?username=<?php echo $_SESSION['login']; ?>&accion=<?php echo $strings['Ver']; ?>"><?php echo $strings['Mi Perfil'] ?></a><br>
                <a class="dropdown-item" href="../Functions/Desconectar.php"><?php echo $strings['Cerrar Sesión'] ?></a> <br>
            </div>
        </li> 
        <?php
    }
}

//Devuelve una lista de todos los usuarios
function ListarUsuarios() {

    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT username FROM usuario ";
    if (!($resultado = $mysqli->query($sql))) {
        echo 'Error en la consulta sobre la base de datos';
    } else {
        $toret = $resultado->fetch_all();
    }
    return $toret;
}

//Devuelve un curso a partir de su id
function obtenerCursos($idCalendario) {

    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT * FROM curso WHERE idCalendario= '" . $idCalendario . "'";
    if (!($resultado = $mysqli->query($sql))) {
        echo 'Error en la consulta sobre la base de datos';
    } else {
        $toret = $resultado->fetch_all();
    }
    return $toret['nombreCurso'];
}

//Devuelve el número de calendarios mas uno
function ObtenerNumCalendarios() {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT MAX(idCalendario) AS max FROM calendario";
    $result = $mysqli->query($sql)->fetch_array();
	$result['max']=$result['max']+1;
    return $result['max'];
}

//Devuelve el id del calendario del usuario
function ObtenerCalendario($username) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT idCalendario FROM calendario WHERE username= '" . $username . "'";
	if (!($result = $mysqli->query($sql))) {
            return 'Error en la función obtenerCalendario.';
    }
	$toret = $result->fetch_array();
    return $toret['idCalendario'];
}

//Devuelve el username del calendario a partir del id
function ObtenerUsername($id) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT username FROM calendario WHERE idCalendario= '" . $id . "'";
	if (!($result = $mysqli->query($sql))) {
            return 'Error en la función obtenerCalendario.';
    }
	$toret = $result->fetch_array();
    return $toret['username'];
}

//Devuelve el ID del último curso insertado
function obtenerUltimoCurso() {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT MAX(idCurso) AS id FROM curso";
    if (!($resultado = $mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        $toret = $resultado->fetch_array();
		return $toret['id'];
    }
}

//Devuelve el ID de un curso a partir de su nombre
function obtenerIdCurso($curso) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $sql = "SELECT idCurso AS id FROM curso WHERE nombreCurso='" . $curso . "'";
    if (!($resultado = $mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        $toret = $resultado->fetch_array();
        $idCurso = $toret['id'];
		return $idCurso;
    }
}

//Devuelve el ID de una asignatura a partir de su nombre
function obtenerIdAsignatura($asignatura) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $sql = "SELECT idAsignatura AS id FROM asignatura WHERE nombreAsignatura='" . $asignatura . "'";
    if (!($resultado = $mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        $toret = $resultado->fetch_array();
        $idAsignatura = $toret['id'];
		return $idAsignatura;
    }
}


//Devuelve los datos de una entrega
    function obtenerDatosEntrega($idCalendarioHoras) {
        $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
        $sql = "SELECT A.asuntoEntrega, A.idCurso, B.dia, B.horaInicio FROM calendario_horas A, horas_posibles B WHERE A.idHoraPosible=B.idHoraPosible AND idCalendarioHoras= '" . $idCalendarioHoras . "'";
        if (($resultado = $mysqli->query($sql))) {
            $result = $resultado->fetch_array();
            return $result;
        } else {
            return 'Error en la consulta sobre la base de datos.';
        }
    }

//Devuelve el número de eventos do los dos días siguientes.
function numEventosAlertas($fecha1, $fecha2) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $sql = "SELECT count(*) AS num FROM calendario_horas A, horas_posibles B WHERE A.idHoraPosible=B.idHoraPosible AND (B.dia='" . $fecha1 . "' OR B.dia='" . $fecha2 . "')";
    if (!($resultado = $mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos.';
    } else {
        $toret = $resultado->fetch_array();
        $numE = $toret['num'];
		return $numE;
    }
}

use om\icalparser;

require_once 'C:\xampp\htdocs\UniOrganizer2\vendor\autoload.php';

function extraerEntregasPrimero(){
	
	$cal = new \om\IcalParser();
	$results = $cal->parseFile('https://calendar.google.com/calendar/ical/d8vvuc64s6rcfv1hlhkq4la4mk%40group.calendar.google.com/public/basic.ics');

	$i = 0;
	$asig = 0;
	foreach($cal->getSortedEvents() as $entrega) {
		$primero[$asig][$i] = $entrega['SUMMARY'];
		$i++;
		$primero[$asig][$i] = $entrega['DTSTART'];
		$i=0;
		$asig++;
	}
	return $primero;
}

function extraerEntregasSegundo(){
	
	$cal = new \om\IcalParser();
	$results = $cal->parseFile('https://calendar.google.com/calendar/ical/3rbodu85ckfn4uois54j2gl44o%40group.calendar.google.com/public/basic.ics');

	$i = 0;
	$asig = 0;
	foreach($cal->getSortedEvents() as $entrega) {
		$segundo[$asig][$i] = $entrega['SUMMARY'];
		$i++;
		$segundo[$asig][$i] = $entrega['DTSTART'];
		$i=0;
		$asig++;
	}
	return $segundo;
}

function extraerEntregasTercero(){
	
	$cal = new \om\IcalParser();
	$results = $cal->parseFile('https://calendar.google.com/calendar/ical/5c07h2s70e1m0qarhruhekoai8%40group.calendar.google.com/public/basic.ics');

	$i = 0;
	$asig = 0;
	foreach($cal->getSortedEvents() as $entrega) {
		$tercero[$asig][$i] = $entrega['SUMMARY'];
		$i++;
		$tercero[$asig][$i] = $entrega['DTSTART'];
		$i=0;
		$asig++;
	}
	return $tercero;
}

function extraerEntregasCuarto(){
	
	$cal = new \om\IcalParser();
	$results = $cal->parseFile('https://calendar.google.com/calendar/ical/uqiavmf6o994nq2f7jtct0kc4s%40group.calendar.google.com/public/basic.ics');

	$i = 0;
	$asig = 0;
	foreach($cal->getSortedEvents() as $entrega) {
		$cuarto[$asig][$i] = $entrega['SUMMARY'];
		$i++;
		$cuarto[$asig][$i] = $entrega['DTSTART'];
		$i=0;
		$asig++;
	}
	return $cuarto;
}

include("../Librerías/simplehtmldom/simple_html_dom.php");
//Funcion para extraer de la web de la universidad, mediante web scraping, todas las asignaturas del grado
function extraerAsignaturas(){
    // Creamos un objeto DOM directamente desde una URL
	$html = file_get_html('https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/index.php?centre=103&ensenyament=O03G081V01&consulta=assignatures');
	$i = 0;
	// buscamos los elementos <div> con un id concreto y nos quedamos con los <td> de su interior
	foreach($html->find('a') as $element){
		if (strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=') !== false) {
			if(strpos($element->innertext, ':') !== false){
				$nombre = preg_split('/:\s/', $element->innertext);
				$array[$i] = $nombre[1];
				$i++;
			}else{
				$array[$i] = $element->innertext;
				$i++;
			}
		}	
	}
	return $array;	
}

function extraerAsignaturasGuia(){
    // Creamos un objeto DOM directamente desde una URL
	$html = file_get_html('https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/index.php?centre=103&ensenyament=O03G081V01&consulta=assignatures');
	$i = 0;
	$c = 0;
	// buscamos los elementos <div> con un id concreto y nos quedamos con los <td> de su interior
	foreach($html->find('a') as $element){
		if (strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=') !== false) {
			if(strpos($element->innertext, ':') !== false){
				$nombre = preg_split('/:\s/', $element->innertext);			
				$array[$c][$i] = $nombre[1];
				$i++;
				$href = $element->href;
				$array[$c][$i] = $href;
				$i=0;
				$c++;
			}else{
				$array[$c][$i] = $element->innertext;
				$i++;
				$href = $element->href;
				$array[$c][$i] = $href;
				$i=0;
				$c++;
			}
		}	
	}
	return $array;	
}

//Funcion para extraer de la web de la universidad, mediante web scraping, los distintos cursos y sus asignaturas correspondientes
function extraerCursos($curso){	
	$i = 0;
	if($curso==1){
		// Creamos un objeto DOM directamente desde una URL
		$html = file_get_html('https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/index.php?centre=103&ensenyament=O03G081V01&consulta=assignatures');
		// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
		foreach($html->find('a') as $element){
			if (strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V011') !== false or strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V012') !== false) {
				if(strpos($element->innertext, ':') !== false){
					$nombre = preg_split('/:\s/', $element->innertext);
					$array[$i] = $nombre[1];
					$i++;
				}else{
					$array[$i] = $element->innertext;
					$i++;
				}
			}	
		}
	}else{
		if($curso==2){
			// Creamos un objeto DOM directamente desde una URL
			$html = file_get_html('https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/index.php?centre=103&ensenyament=O03G081V01&consulta=assignatures');
			// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
			foreach($html->find('a') as $element){
				if (strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V013') !== false or strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V014') !== false) {
					if(strpos($element->innertext, ':') !== false){
						$nombre = preg_split('/:\s/', $element->innertext);
						$array[$i] = $nombre[1];
						$i++;
					}else{
						$array[$i] = $element->innertext;
						$i++;
					}
				}	
			}
		}else{
			if($curso==3){
				// Creamos un objeto DOM directamente desde una URL
				$html = file_get_html('https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/index.php?centre=103&ensenyament=O03G081V01&consulta=assignatures');
				// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
				foreach($html->find('a') as $element){
					if (strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V015') !== false or strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V016') !== false) {
						if(strpos($element->innertext, ':') !== false){
							$nombre = preg_split('/:\s/', $element->innertext);
							$array[$i] = $nombre[1];
							$i++;
						}else{
							$array[$i] = $element->innertext;
							$i++;
						}
					}	
				}
			}else{
				if($curso==4){
					// Creamos un objeto DOM directamente desde una URL
					$html = file_get_html('https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/index.php?centre=103&ensenyament=O03G081V01&consulta=assignatures');
					// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
					foreach($html->find('a') as $element){
						if (strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V017') !== false or strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V018') !== false or strpos($element->href, '?centre=103&ensenyament=O03G081V01&assignatura=O03G081V019') !== false) {
							if(strpos($element->innertext, ':') !== false){
								$nombre = preg_split('/:\s/', $element->innertext);
								$array[$i] = $nombre[1];
								$i++;
							}else{
								$array[$i] = $element->innertext;
								$i++;
							}
						}	
					}
				}
			}
		}
	}
	return $array;
}
