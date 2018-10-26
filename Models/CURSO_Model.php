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
				return true;
			}  
        }
    }

//Crea un nuevo curso en el sistema
    function insertarCurso() {
        $this->ConectarBD();
		
        $sql = "INSERT INTO curso (nombreCurso, descripcionCurso, idCalendario) VALUES ('" . $this->nombreCurso . "','" . $this->descripcionCurso . "','" . $this->idCalendario . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la inserción de curso.';
        } else {
            return 'Inserción realizada con éxito';
        }
		
    }
	
//Crea los eventos para los exámenes de las asignaturas de un curso
	function crearExamenes($idCurso, $idAsignatura, $datos1, $datos2, $datos3) {
        $this->ConectarBD();
		
		$idCalendario = ObtenerCalendario($_SESSION['login']);
		
		$fechaA = preg_split('/\//', $datos1[0]);
		$fechaOk = $fechaA[1] . '/' . $fechaA[0] . '/' . $fechaA[2];
		$fecha1 = date('Y-m-d', strtotime($fechaOk));
		$horaA = $datos1[2];
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
				$sql2 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "','" . $idAsignatura . "', '" . $idCurso . "','" . $idHoraPosibleA . "', NULL )";
				if (!($resultado = $this->mysqli->query($sql2))) {
					return 'Error en la inserción de calendario.';
				} 
			}
		}else{
			$sql2 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "','" . $idAsignatura . "', '" . $idCurso . "','" . $idHoraPosibleA . "', NULL )";
			if (!($resultado = $this->mysqli->query($sql2))) {
				return 'Error en la inserción de calendario.';
			} 
		}
		
		$fechaB = preg_split('/\//', $datos2[0]);
		$fechaOk = $fechaB[1] . '/' . $fechaB[0] . '/' . $fechaB[2];
		$fecha2 = date('Y-m-d', strtotime($fechaOk));;
		$horaB = $datos2[2];
		$sql3 = "SELECT idHoraPosible AS id FROM horas_posibles WHERE dia='" . $fecha2 . "' AND horaInicio='" . $horaB . "'";
		if (!($resultado = $this->mysqli->query($sql3))) {
			return 'No se ha podido conectar con la base de datos en SELECT idHoraPosible.';
		} else {
			$result = $resultado->fetch_array();
			$idHoraPosibleB = $result['id'];
		}
		$sql = "SELECT idCalendarioHoras AS id FROM calendario_horas WHERE idCalendario='" . $idCalendario . "' AND idAsignatura='" . $idAsignatura . "' AND idHoraPosible='" . $idHoraPosibleB . "'";
		if ($resultado = $this->mysqli->query($sql)) {
			$result = $resultado->fetch_array();
			$idHora = $result['id'];
			if(!($idHora)){
				$sql4 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "','" . $idAsignatura . "', '" . $idCurso . "','" . $idHoraPosibleB . "', NULL )";
				if (!($resultado = $this->mysqli->query($sql4))) {
					return 'Error en la inserción de calendario.';
				} 
			}
		}else{
			$sql4 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "','" . $idAsignatura . "', '" . $idCurso . "','" . $idHoraPosibleB . "', NULL )";
			if (!($resultado = $this->mysqli->query($sql4))) {
				return 'Error en la inserción de calendario.';
			} 
		}
		
		$fechaC = preg_split('/\//', $datos3[0]);
		$fechaOk = $fechaC[1] . '/' . $fechaC[0] . '/' . $fechaC[2];
		$fecha3 = date('Y-m-d', strtotime($fechaOk));
		$horaC = $datos3[2];
		$sql5 = "SELECT idHoraPosible AS id FROM horas_posibles WHERE dia='" . $fecha3 . "' AND horaInicio='" . $horaC . "'";
		if (!($resultado = $this->mysqli->query($sql5))) {
			return 'No se ha podido conectar con la base de datos en SELECT idHoraPosible.';
		} else {
			$result = $resultado->fetch_array();
			$idHoraPosibleC = $result['id'];
		}
		$sql = "SELECT idCalendarioHoras AS id FROM calendario_horas WHERE idCalendario='" . $idCalendario . "' AND idAsignatura='" . $idAsignatura . "' AND idHoraPosible='" . $idHoraPosibleC . "'";
		if ($resultado = $this->mysqli->query($sql)) {
			$result = $resultado->fetch_array();
			$idHora = $result['id'];
			if(!($idHora)){
				$sql6 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "','" . $idAsignatura . "', '" . $idCurso . "','" . $idHoraPosibleC . "', NULL )";
				if (!($resultado = $this->mysqli->query($sql6))) {
					return 'Error en la inserción de calendario.';
				} 
			}
		}else{
			$sql6 = "INSERT INTO calendario_horas( idCalendario, idAsignatura, idCurso, idHoraPosible, idAlerta) VALUES ('" . $idCalendario . "','" . $idAsignatura . "', '" . $idCurso . "','" . $idHoraPosibleC . "', NULL )";
			if (!($resultado = $this->mysqli->query($sql6))) {
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
            return true;
        }
    }
	
//Inserta una asignatura en el curso especificado
	function asignarAsignatura($idCurso, $idAsignatura) {
        $this->ConectarBD();

        $sql = "INSERT INTO asignatura_curso VALUES ('" . $idCurso . "','" . $idAsignatura . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
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