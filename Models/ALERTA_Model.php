<?php

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

//Inserta una alerta y su correspondiente evento en el calendario
    function Insertar($fecha, $hora, $idCurso) {
        $this->ConectarBD();
		
		$hora = split($hora, ':');
		if($hora[1]>30){
			$hora[1] = 00;
			$hora[0] = $hora[0]+1;
		}else{
			$hora[1] = 00;
		}
		$horaOk = $horaA[0] . ':' . $horaA[1] . ':' . $horaA[2];
		
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
			
			$sql = "SELECT idHoraPosible AS id FROM horas_posibles WHERE dia='" . $fecha . "' AND horaInicio='" . $horaOk . "'";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'No se ha podido conectar con la base de datos en SELECT idHora.';
			} else {
				$result = $resultado->fetch_array();
				$idHora = $result['id'];
			}
			
			$idCalendario = ObtenerCalendario($_SESSION['login']);
			
			$sql = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, asuntoEntrega, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "', NULL, '" . $idCurso . "', NULL,'" . $idHora . "','" . $idInsertada . "')";
            if (!($resultado = $this->mysqli->query($sql))) {
				$sql = "DELETE FROM alerta WHERE idAlerta='" . $idInsertada . "'";
				$this->mysqli->query($sql);
				return 'No se ha podido conectar con la base de datos en INSERT calendario_horas.';
			}
        
            return 'Inserción realizada con éxito';
        }
    }
	
	//Inserta una alerta y su correspondiente evento en el calendario
    function Modificar($fecha, $hora, $idCalendarioHoras) {
        $this->ConectarBD();
		
		$hora = split($hora, ':');
		if($hora[1]>30){
			$hora[1] = 00;
			$hora[0] = $hora[0]+1;
		}else{
			$hora[1] = 00;
		}
		$horaOk = $horaA[0] . ':' . $horaA[1] . ':' . $horaA[2];
		
        $sql = "SELECT * FROM ALERTA";
        if (!$result = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos.';
        } else {
			
			$sql = "UPDATE alerta SET asuntoAlerta='" . $this->asuntoAlerta . "', descripcionAlerta='" . $this->descripcionAlerta . "' WHERE idAlerta='" . $this->idAlerta . "'";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'Error en update alerta.';
			}
			
			$sql = "SELECT idHoraPosible AS id FROM horas_posibles WHERE dia='" . $fecha . "' AND horaInicio='" . $horaOk . "'";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'No se ha podido conectar con la base de datos en SELECT idHora.';
			} else {
				$result = $resultado->fetch_array();
				$idHoraPosible = $result['id'];
			}
			
			$sql = "UPDATE calendario_horas SET idHoraPosible='" . $idHoraPosible . "', idAlerta='" . $this->idAlerta . "' WHERE idCalendarioHoras='" . $idCalendarioHoras . "'";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'Error al actualizar el evento.';
			}
            return 'Inserción realizada con éxito';
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


//Devuelve una lista de todas las alertas asociadas un usuario
    function Listar($idCalendario) {

            $this->ConectarBD();
            $sql = "SELECT A.idAlerta, A.asuntoAlerta, A.descripcionAlerta FROM alerta as A, calendario_horas as C WHERE A.idAlerta=C.idAlerta AND C.idCalendario='" . $idCalendario . "'";
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
	
//Devuelve una lista de todas las alertas
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

//Elimina una alerta del sistema y 
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

//Devuelve los datos de una alerta
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
}

?>
