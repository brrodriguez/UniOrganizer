<?php

//-------------------------------------------------------
include '../Functions/LibraryFunctions.php';

class ALERTA_Model {

//Parámetros de la clase Alerta
    var $idAlerta;
    var $asuntoAlerta;
    var $descripcionAlerta;
    var $mysqli;

    function __construct($idAlerta, $asuntoAlerta, $descripcionAlerta) {
        $this->idAlerta = $idAlerta;
        $this->asuntoAlerta = $asuntoAlerta;
        $this->descripcionAlerta = $descripcionAlerta;
    }

//Función para conectarnos a la Base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "root", "", "uniorganizer");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//Insertar alerta para un usuario
    function Insertar($fecha, $hora) {
        $this->ConectarBD();
        //En el caso de las alertas no hace falta hacer comprobacion de si existe el id puesto que este es incremental
        $sql = "SELECT * FROM ALERTA";
        if (!$result = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos.';
        } else {
			
			$sql = "INSERT INTO alerta( asuntoAlerta, descripcionAlerta) VALUES ('" . $this->asuntoAlerta . "','" . $this->descripcionAlerta . "')";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'Error en insert alerta.';
			}
			
			$sql = "SELECT MAX(idAlerta) AS id FROM alerta";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'No se ha podido conectar con la base de datos en MAX.';
			} else {
				$result = $resultado->fetch_array();
				$idInsertada = $result['id'];
			}
			
			$sql = "SELECT idHoraPosible AS id FROM horas_posibles WHERE dia='" . $fecha . "' AND horaInicio='" . $hora . "'";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'No se ha podido conectar con la base de datos en SELECT idHora.';
			} else {
				$result = $resultado->fetch_array();
				$idHora = $result['id'];
			}
			
			$idCalendario = ObtenerCalendario($_SESSION['login']);
			
			$sql = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "', NULL, NULL,'" . $idHora . "','" . $idInsertada . "')";
            if (!($resultado = $this->mysqli->query($sql))) {
				$sql = "DELETE FROM alerta WHERE idAlerta='" . $idInsertada . "'";
				$this->mysqli->query($sql);
				return 'No se ha podido conectar con la base de datos en INSERT calendario_horas.';
			}
        
            return 'Inserción realizada con éxito';
        }
    }

    function ConsultarMailUsuario($username) {
        $this->ConectarBD();
        $sql = "SELECT email FROM USUARIO WHERE username ='" . $username . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'No se ha podido conectar con la base de datos.';
        } else {
            $result = $resultado->fetch_array();
            return $result['email'];
        }
    }


//Consulta todos los usuarios
    function ConsultarUsuarios() {
        $this->ConectarBD();
        $sql = "SELECT username FROM USUARIO";

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


//Devuelve la información de todas las alertas asociadas a este usuario
//para esto hace falta saber el id del calendario del usuario que está accediendo a la función.
    function Listar($idCalendario) {

            $this->ConectarBD();
            $sql = "SELECT idAlerta, asuntoAlerta, descripcionAlerta FROM alerta as A, calendario_horas as C WHERE A.idAlerta=C.idAlerta AND C.idCalendario='" . $idCalendario . "'";
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
	
	//Devuelve la información de todas las alertas asociadas a este usuario
//para esto hace falta saber el id del calendario del usuario que está accediendo a la función.
    function ListarTodo() {

            $this->ConectarBD();
            $sql = "SELECT * FROM alerta ORDER BY idAlerta DESC";
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

//Funcion para dar de baja una alerta en el sistema.
    function Borrar() {
        $this->ConectarBD();
        $sql = "SELECT * FROM alerta WHERE idAlerta= '" . $this->idAlerta . "'";

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else if ($resultado->num_rows == 0) {
            return 'No se puede borrar porque no existe esa alerta.';
        } else {
            $sql = "DELETE FROM alerta WHERE idAlerta='" . $this->idAlerta . "'";
            $this->mysqli->query($sql);
            return "La alerta fue borrada con éxito.";
        }
    }

    function RellenaDatos() {
        $this->ConectarBD();
        $sql = "SELECT idAlerta, asuntoAlerta, descripcionAlerta FROM alerta WHERE idAlerta= '" . $this->idAlerta . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    function Ver() {
        $this->ConectarBD();
        $sql = "SELECT * FROM alerta WHERE idAlerta= '" . $this->idAlerta . "'";
        if (($resultado = $this->mysqli->query($sql))) {
            $result = $resultado->fetch_array();
            return $result;
        } else {
            return 'Error en la consulta sobre la base de datos.';
        }
    }

    function Enviar_Email() {

        $cont = 0;

        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 465;
        $this->mail->username = $this->username;
        $this->mail->Password = $this->password;
        $this->mail->setFrom($this->username, $this->ALERTA_NOMBRE_REMITENTE);
        $this->mail->addReplyTo($this->username, $this->ALERTA_NOMBRE_REMITENTE);
        $this->mail->Subject = $this->asuntoAlerta;
        $this->mail->msgHTML($this->descripcionAlerta);
        $this->mail->CharSet = "UTF-8";

    }

}

?>
