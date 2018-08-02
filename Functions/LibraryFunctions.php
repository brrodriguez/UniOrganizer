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

//Genera un link para la página a partir de un nombre
function GenerarLinkPagina($PAGINA_NOM) {
    $link = str_replace(" ", "_", $PAGINA_NOM);
    $s = '../Views/';
    $s .= $link;
    $s .= '_Vista.php';
    return $s;
}

/*
  //Genera el link de un controlador a partir del nombre de la funcionalidad
  function GenerarLinkControlador($CON_NOM) {
  $link = str_replace(" ", "_", $CON_NOM);
  $s = '../Controllers/';
  $s .= $link;
  $s .= '_Controller.php';
  return $s;
  }
 */

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
 
//Devuelve el nombre de rol a partir del id de rol
function ConsultarNOMRol($idRol) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT nombreRol FROM ROL WHERE idRol='" . $idRol . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['nombreRol'];
}

function ConsultarNombreCurso($idCurso) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT nombreCurso FROM Curso WHERE idCurso='" . $idCurso . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['nombreCurso'];
}
 
function ConsultarNombreActividadGrupal($idActividadGrupal) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT nombreActividadGrupal FROM ACTIVIDADGRUPAL WHERE idActividadGrupal='" . $idActividadGrupal . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['nombreActividadGrupal'];
}
 
function ConsultarNombreActividadIndividual($idActividadGrupal) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT nombreActividadIndividual FROM ACTIVIDADINDIVIDUAL WHERE idActividadIndividual='" . $idActividadGrupal . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['nombreActividadIndividual'];
}

function ConsultarEmailUsuario($username) {
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT email FROM Usuario WHERE username='" . $username . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['email'];
}

//añade a la pagina default los enlaces correspondientes a las funcionalidades
function añadirFuncionalidades($NOM) {
    include '../Locates/Strings_' . $NOM['IDIOMA'] . '.php';
    $mysqli = new mysqli("localhost", "root", "", "uniorganizer");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $rol = "SELECT tipoUsuario FROM USUARIO  WHERE username='" . $NOM['login'] . "'";
    $sql = "SELECT DISTINCT categoriaFuncionalidad FROM FUNCIONALIDAD, FUNCIONALIDAD_ROL WHERE FUNCIONALIDAD_ROL.idFuncionalidad = FUNCIONALIDAD.idFuncionalidad AND FUNCIONALIDAD_ROL.idRol=(" . $rol . ")";
//$sql = "SELECT idFuncionalidad FROM Funcionalidad_Rol WHERE idRol=(" . $rol . ")";
    if (!($resultado = $mysqli->query($sql))) {
        echo 'Error en la consulta sobre la base de datos';
    } else {
        while ($fila = $resultado->fetch_array()) {
            $funcionalidad = $fila['categoriaFuncionalidad'];

            switch ($funcionalidad) {

                case "Gestion Usuarios":
                        ?><li><a style="font-size:15px;" href="../Controllers/USUARIO_Controller.php"><?php echo $strings['Gestión de Usuarios']; ?></a></li> <?php
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
//        echo '<li role="presentation"><a href="" class="m1">Sobre Nosotros</a></li>';
//        echo '<li role="presentation"><a href="" class="m1">Contacto</a></li>';
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
                    <a class="dropdown-item" href="../Controllers/USUARIO_Controller.php?username=<?php echo $_SESSION['login']; ?>&accion=<?php echo $strings['MisCursos']; ?>"><?php echo $strings['MisCursos'] ?></a><br>
                <a class="dropdown-item" href="../Functions/Desconectar.php"><?php echo $strings['Cerrar Sesión'] ?></a> <br>
            </div>
        </li> 
        <?php
    }
}

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


//Devuelve el id del calendario del usuario
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

//Devuelve el número de calendarios mas uno
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
?>


