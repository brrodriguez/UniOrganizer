<?php

//-------------------------------------------------------
include '../Functions/LibraryFunctions.php';

class USUARIO_Modelo {

//Parámetros de la clase usuario
    var $username;
    var $password;
	var $tipoUsuario;
    var $nombre;
    var $apellidos;
    var $dni;
	var $fechaNac;
	var $niu;
    var $email;
	var $newPassword;
    var $mysqli;

    function __construct($username, $password, $tipoUsuario, $nombre, $apellidos, $dni, $fechaNac, $niu, $email, $newPassword) {
        $this->username = $username;
        $this->password = $password;
		$this->tipoUsuario = (int) $tipoUsuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
		$this->niu = $niu;
		$time = strtotime($fechaNac);
		$newformat = date('Y-m-d',$time);
		$this->fechaNac = $newformat;
        $this->email = $email;
    }

//Función para conectarnos a la Base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "root", "", "uniorganizer");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//Comprueba que el usuario pueda loguearse
    function Login() {
        $this->ConectarBD();
        $sql = "SELECT * FROM USUARIO WHERE username = '" . $this->username . "'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            $tupla = $result->fetch_array();

            if ($tupla['password'] == md5($this->password)) {
                return true;
            } else {
                return 'La contraseña para este usuario es errónea';
            }
        } else {
            return "El usuario no existe";
        }
    }
	
	//Comprueba que el usuario pueda registrarse
    function Registro() {
        $this->ConectarBD();
        $sql = "SELECT * FROM USUARIO WHERE username = '" . $this->username . "'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 0) {
			return true;
			
        } else {
            return "El usuario ya existe";
        }
    }

//Insertar usuario
    function Insertar() {
        $this->ConectarBD();
        if ($this->username <> '') {
            $sql = "SELECT * FROM USUARIO where username = '" . $this->username . "'";
            if (!($result = $this->mysqli->query($sql))) {
                return 'No se ha podido conectar con la base de datos';
            }
            if ($result->num_rows == 0) {
                $sql1 = "SELECT * FROM USUARIO where dni = '" . $this->dni . "'";
                $result1 = $this->mysqli->query($sql1);
                if ($result1->num_rows == 0) {
                    $sql2 = "SELECT * FROM USUARIO where email = '" . $this->email . "'";
                    $result2 = $this->mysqli->query($sql2);
                    if ($result2->num_rows == 0) {
						
						$sql = "INSERT INTO USUARIO VALUES ('" . $this->username . "','" . md5($this->password) . "','" . $this->tipoUsuario . "','" . $this->nombre . "','" . $this->apellidos . "','" . $this->dni . "','" . $this->fechaNac . "','" . $this->niu . "','" . $this->email . "')";
                        if (!$result = $this->mysqli->query($sql)) {
							return 'No se inserto el usuario';
						}
						
						$sql = "INSERT INTO USUARIO_ROL VALUES ('" . $this->username . "','" . $this->tipoUsuario . "')";
                        if (!$result = $this->mysqli->query($sql)) {
							return 'No se inserto el usuario_rol';
						}	
						
						$sql = "INSERT INTO CALENDARIO (username) VALUES ('" . $this->username . "')";
                        if (!$result = $this->mysqli->query($sql)) {
							return 'No se inserto el calendario';
						}
								
						
						return 'Inserción realizada con éxito';
                    } else {
                        return "Ya existe un Usuario con ese E-mail";
                    }
                } else {
                    return "Ya existe un Usuario con ese DNI";
                }
            } else {
                return "Ya existe un Usuario con ese username";
            }

            return 'Inserción realizada con éxito2';
        } else {
            return 'El usuario ya existe en la base de datos';
		}
	}

//Devuelve la información de todos los usuarios
    function ConsultarTodo($user) {

        $this->ConectarBD();
        
        $sql = "SELECT * FROM USUARIO";
        

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }

            return $toret;
        }
    }

    function Borrar() {
        $this->ConectarBD();
        $sql = "SELECT * FROM USUARIO WHERE username = '" . $this->username . "'";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows == 1) {
            $sql = "DELETE FROM USUARIO WHERE username = '" . $this->username . "'";
            $this->mysqli->query($sql);
			
            return "El usuario ha sido borrado correctamente";
        } else
            return "El usuario no existe";
    }

//Devuelve los valores almacenados para un determinado usuario para posteriormente rellenar un formulario
    function RellenaDatos() {
        $this->ConectarBD();
        $sql = "SELECT * FROM USUARIO WHERE USUARIO.username = '" . $this->username . "'";

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

//Actualiza en la base de datos la información de un determinado usuario
    function Modificar() {

        $this->ConectarBD();
        $sql = "SELECT * FROM USUARIO where username = '" . $this->username . "'";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows == 1) {
            
			$sql = "UPDATE `usuario` SET nombre='" . $this->nombre . "',apellidos='" . $this->apellidos . "',dni='" . $this->dni . "',fechaNac='" . $this->fechaNac . "',niu='" . $this->niu . "',email='" . $this->email . "',password='" . md5($this->newPassword) . "' WHERE username='" . $this->username . "'";
			
            $this->mysqli->query($sql);

            if (!($resultado = $this->mysqli->query($sql))) {

                return "Se ha producido un error en la modificación del usuario";
            } else {
                return "El usuario se ha modificado con éxito";
            }
        } else {
            return "El usuario no existe";
        }
    }

    function consultarCursos() {
        $this->ConectarBD();
        $sql = "SELECT * FROM CURSO WHERE username = '" . $this->username . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }

    function consultarAlertas() {
        $this->ConectarBD();
        $sql = "SELECT * FROM ALERTA WHERE username = '" . $this->username . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }

    function consultarAsignaturas() {
        $this->ConectarBD();
        $sql = "SELECT * FROM ASIGNATURA WHERE username = '" . $this->username . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }



}

?>
