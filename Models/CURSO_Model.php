<?php

include '../Functions/LibraryFunctions.php';

class CURSO_Model {

//Parámetros de la clase Curso
	var $idCurso;
    var $nombreCurso;
    var $descripcionCurso;
	var $idCalendario;

    function __construct($idCurso, $nombreCurso, $descripcionCurso, $idCalendario) {
		$this->idCurso = $idCurso;
        $this->nombreCurso = $nombreCurso;
        $this->descripcionCurso = $descripcionCurso;
		$this->idCalendario = (int) $idCalendario;
    }

//Función para conectarnos a la Base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "root", "", "uniorganizer");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//Devuelve una lista con los cursos del usuario
    function obtenerCursosUsuario($idCalendario) {
        $this->ConectarBD();
        $sql = "SELECT * FROM `curso` WHERE (idCalendario='" . $idCalendario . "') ";
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

//Devuelve una lista con todos los cursos del sistema
    function obtenerCursos() {
        $this->ConectarBD();
        $sql = "SELECT * FROM curso";
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

//Elimina un curso del sistema y sus correspondientes eventos
    function eliminarCurso($id) {
        $this->ConectarBD();
        $sql = "DELETE FROM curso WHERE idCurso='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
			$sql = "DELETE FROM calendario_horas WHERE idCurso='" . $id . "'";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'Error en la consulta sobre la base de datos.';
			}else{
				return 'Curso eliminado correctamente.';
			}  
        }
    }

//Crea un nuevo curso en el sistema
    function insertarCurso() {
        $this->ConectarBD();
		
		$sql = "SELECT idCurso FROM curso WHERE nombreCurso = '" . $this->nombreCurso . "'";
		$resultado = $this->mysqli->query($sql);
        if ($resultado->num_rows == 0) {
			$sql = "INSERT INTO curso (nombreCurso, descripcionCurso, idCalendario) VALUES ('" . $this->nombreCurso . "','" . $this->descripcionCurso . "','" . $this->idCalendario . "')";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'Error en la inserción de curso.';
			} else {
				return 'Inserción realizada con éxito';
			}
        } else {
			return 'Error: ya existe un curso con ese nombre.';
		}
    }
	
//Permite filtrar por nombre de usuario
	function filtrar($username) {
        $this->ConectarBD();

        if ($username == '') { //0
            $sql = "SELECT * FROM curso ";
        } else if ($username != '') { //1
			$id = ObtenerCalendario($username);
            $sql = "SELECT * FROM curso WHERE idCalendario = '" . $id . "'";
        }

        if (!$resultado = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos';
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
	
//Crea los eventos para los exámenes de las asignaturas de un curso
	function crearEntregas($idCurso, $idAsignatura, $entrega, $datos) {
        $this->ConectarBD();
		
		$idCalendario = ObtenerCalendario($_SESSION['login']);
		$añoA = substr($datos, 0, 4);
		$mesA = substr($datos, 5, 2);
		$diaA = substr($datos, 8, 2);
		$fechaA = $añoA . '/' . $mesA . '/' . $diaA;
		$horasA = (int) substr($datos, 11, 2);
		
		if($mesA==11 or $mesA==12 or $mesA==1 or $mesA==2 or $mesA==3){
			$horasA = $horasA+1;
		}else{
			$horasA = $horasA+2;
		}
		
		$minsA = (int) substr($datos, 14, 2);
		
		if($minsA <= 30){
			$minsA = '00';
		}else{
			$minsA = '00';
			$horasA++;
		}
		
		$horaA = $horasA . ':' . $minsA . ':00';
		$horaA = date('H:i:s', strtotime($horaA));
		$fecha1 = date('Y-m-d', strtotime($fechaA));
		
		$sql1 = "SELECT idHoraPosible AS id FROM horas_posibles WHERE dia='" . $fecha1 . "' AND horaInicio='" . $horaA . "'";
		if (!($resultado = $this->mysqli->query($sql1))) {
			return 'No se ha podido conectar con la base de datos en SELECT idHoraPosible.';
		} else {
			$result = $resultado->fetch_array();
			$idHoraPosibleA = $result['id'];
		}
		$sql = "SELECT idCalendarioHoras AS id FROM calendario_horas WHERE idCalendario='" . $idCalendario . "' AND idAsignatura='" . $idAsignatura . "' AND idHoraPosible='" . $idHoraPosibleA . "'";
		if ($resultado = $this->mysqli->query($sql)) {
			$result = $resultado->fetch_array();
			$idHora = $result['id'];
			if(!($idHora)){
				$sql2 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, asuntoEntrega, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "', '" . $idAsignatura . "', '" . $idCurso . "', '" . $entrega . "', '" . $idHoraPosibleA . "', NULL )";
				if (!($resultado = $this->mysqli->query($sql2))) {
					return 'Error en la inserción de calendario.';
				} 
			}
		}else{
			$sql2 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, asuntoEntrega, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "', '" . $idAsignatura . "', '" . $idCurso . "', '" . $entrega . "', '" . $idHoraPosibleA . "', NULL )";
			if (!($resultado = $this->mysqli->query($sql2))) {
				return 'Error en la inserción de calendario.';
			} 
		}	
		return 'Inserción realizada con éxito.';
    }

//Devuelve los datos de un curso
    function obtenerCursoDetalle($id) {
        $this->ConectarBD();
        $sql = "SELECT * FROM curso WHERE idCurso='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return $resultado->fetch_array();
        }
    }

//Actualiza los datos de un curso
    function modificarCurso($id) {
        $this->ConectarBD();
        $sql = "UPDATE `curso` SET nombreCurso='" . $this->nombreCurso . "',descripcionCurso='" . $this->descripcionCurso . "' WHERE idCurso='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return 'Curso modificado correctamente.';
        }
    }
	
//Inserta una asignatura en el curso especificado
	function asignarAsignatura($idCurso, $idAsignatura) {
        $this->ConectarBD();

        $sql = "INSERT INTO asignatura_curso VALUES ('" . $idCurso . "','" . $idAsignatura . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        }else{
			return 'Asignaturas asignadas correctamente.';
		}
    }

//Elimina una asignatura de de un curso
    function desasignarAsignatura($idCurso, $idAsignatura) {
        $this->ConectarBD();
		$idCalendario = $_SESSION['calendario'];
        $sql = "DELETE FROM asignatura_curso WHERE idCurso='" . $idCurso . "' AND idAsignatura=" . $idAsignatura . "";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        }
		$sql = "DELETE FROM calendario_horas WHERE idCalendario='" . $idCalendario . "' AND idCurso='" . $idCurso . "' AND idAsignatura=" . $idAsignatura . "";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        }
		return 'Asignaturas eliminadas correctamente.';
    }

//Devuelve las asignaturas pertenecientes al curso especificado
    function obtenerRelacion_CursoAsignaturas($idCurso) {
        $this->ConectarBD();
        $sql = "SELECT *
				FROM asignatura_curso AC, asignatura A
				WHERE AC.idAsignatura=A.idAsignatura AND AC.idCurso='" . $idCurso . "'
				GROUP BY AC.idAsignatura;";
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