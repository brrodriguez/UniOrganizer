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
					
                case "Gestion Alertas":
                    ?><li><a style="font-size:15px;" href="../Controllers/ALERTA_Controller.php"><?php echo $strings['Gestión de Alertas']; ?></a></li> <?php
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

include("../Librerías/simplehtmldom/simple_html_dom.php");
//Funcion para extraer de la web de la universidad, mediante web scraping, todas las asignaturas del grado
function extraerAsignaturas(){
    // Creamos un objeto DOM directamente desde una URL
	$html = file_get_html('http://historia.uvigo.es/es/docencia/guias-docentes');
	$i=0;
	// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
	foreach($html->find('a') as $element){
		if (strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura') !== false) {
			$array[$i] = $element->innertext;
			$i++;
		}	
	}	
	return $array;	
}

//Funcion para extraer de la web de la universidad, mediante web scraping, los distintos cursos y sus asignaturas correspondientes
function extraerCursos($curso){	
	$i=0;
	
	if($curso==1){
		// Creamos un objeto DOM directamente desde una URL
		$html = file_get_html('http://historia.uvigo.es/es/docencia/guias-docentes#gxh1c');
		// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
		foreach($html->find('table[class=table table-bordered table-condensed]') as $element){
			foreach($element->find('a') as $element){
				if (strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura=O02G251V011') !== false or strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura=O02G251V012') !== false) {
					$array[$i] = $element->innertext;
					$i++;
				}
			}
		}
	}else{
		if($curso==2){
			// Creamos un objeto DOM directamente desde una URL
			$html = file_get_html('http://historia.uvigo.es/es/docencia/guias-docentes#gxh2c');
			// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
			foreach($html->find('table[class=table table-bordered table-condensed]') as $element){
				foreach($element->find('a') as $element){
					if (strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura=O02G251V013') !== false or strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura=O02G251V014') !== false) {
						$array[$i] = $element->innertext;
						$i++;
					}
				}
			}
		}else{
			if($curso==3){
				// Creamos un objeto DOM directamente desde una URL
				$html = file_get_html('http://historia.uvigo.es/es/docencia/guias-docentes#gxh3c');
				// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
				foreach($html->find('table[class=table table-bordered table-condensed]') as $element){
					foreach($element->find('a') as $element){
						if (strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura=O02G251V015') !== false or strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura=O02G251V016') !== false) {
							$array[$i] = $element->innertext;
							$i++;
						}
					}
				}
			}else{
				if($curso==4){
					// Creamos un objeto DOM directamente desde una URL
					$html = file_get_html('http://historia.uvigo.es/es/docencia/guias-docentes#gxh4c');
					// buscamos todos los elementos <a> y nos quedamos con los que nos interesan
					foreach($html->find('table[class=table table-bordered table-condensed]') as $element){
						foreach($element->find('a') as $element){
							if (strpos($element->href, 'https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/?centre=102&ensenyament=O02G251V01&assignatura=O02G251V019') !== false ) {
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

//Funcion para extraer de la web de la universidad, mediante web scraping, todos los exámenes de las asignaturas de primero
function extraerExamenesPrimero(){
    // Creamos un objeto DOM directamente desde una URL
	$html = file_get_html('http://historia.uvigo.es/es/docencia/examenes');
	$i=1;
	$asig = 1;
	// buscamos los elementos <div> con un id concreto y nos quedamos con los <td> de su interior
	foreach($html->find('div[id=gxh18191c]') as $element){
					foreach($element->find('td') as $element){
						$primero[$asig][$i] = $element->innertext;
						$i++;
						if($i==5){
							$i=1;
							$asig++;
						}					
					}

	}
	return $primero;
}

//Funcion para extraer de la web de la universidad, mediante web scraping, todos los exámenes de las asignaturas de segundo
function extraerExamenesSegundo(){
    // Creamos un objeto DOM directamente desde una URL
	$html = file_get_html('http://historia.uvigo.es/es/docencia/examenes');
	$i=1;
	$asig = 1;
	// buscamos los elementos <div> con un id concreto y nos quedamos con los <td> de su interior
	foreach($html->find('div[id=gxh18192c]') as $element){
					foreach($element->find('td') as $element){
						$segundo[$asig][$i] = $element->innertext;
						$i++;
						if($i==5){
							$i=1;
							$asig++;
						}					
					}
	}
	return $segundo;
}

//Funcion para extraer de la web de la universidad, mediante web scraping, todos los exámenes de las asignaturas de tercero
function extraerExamenesTercero(){
    // Creamos un objeto DOM directamente desde una URL
	$html = file_get_html('http://historia.uvigo.es/es/docencia/examenes');
	$i=1;
	$asig = 1;
	// buscamos los elementos <div> con un id concreto y nos quedamos con los <td> de su interior
	foreach($html->find('div[id=gxh18193c]') as $element){
					foreach($element->find('td') as $element){
						$tercero[$asig][$i] = $element->innertext;
						$i++;
						if($i==5){
							$i=1;
							$asig++;
						}					
					}	
	}
	return $tercero;
}

//Funcion para extraer de la web de la universidad, mediante web scraping, todos los exámenes de las asignaturas de cuarto
function extraerExamenesCuarto(){
    // Creamos un objeto DOM directamente desde una URL
	$html = file_get_html('http://historia.uvigo.es/es/docencia/examenes');
	$i=1;
	$asig = 1;
	// buscamos los elementos <div> con un id concreto y nos quedamos con los <td> de su interior
	foreach($html->find('div[id=gxh18194c]') as $element){
					foreach($element->find('td') as $element){
						$cuarto[$asig][$i] = $element->innertext;
						$i++;
						if($i==5){
							$i=1;
							$asig++;
						}					
					}	
	}
	return $cuarto;
}
?>