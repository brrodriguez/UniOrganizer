<?php

include '../Functions/LibraryFunctions.php';

class CURSO_Model {

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

    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "root", "", "uniorganizer");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

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

    function eliminarCurso($id) {
        $this->ConectarBD();
        $sql = "DELETE FROM curso WHERE idCurso='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return true;
        }
    }

    function insertarCurso() {
        $this->ConectarBD();
		
        $sql = "INSERT INTO curso (nombreCurso, descripcionCurso, idCalendario) VALUES ('" . $this->nombreCurso . "','" . $this->descripcionCurso . "','" . $this->idCalendario . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la inserción de curso.';
        } else {
            return 'Inserción realizada con éxito';
        }
    }

    function obtenerCursoDetalle($id) {
        $this->ConectarBD();
        $sql = "SELECT * FROM curso WHERE idCurso='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return $resultado->fetch_array();
        }
    }

    function modificarCurso($id) {
        $this->ConectarBD();
        $sql = "UPDATE `curso` SET nombreCurso='" . $this->nombreCurso . "',descripcionCurso='" . $this->descripcionCurso . "' WHERE idCurso='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return true;
        }
    }

    function asignarAsignaturas($idCurso, $listaAsignaturas) {
        $this->ConectarBD();

        $sql = "INSERT INTO asignatura_curso VALUES ('" . $idCurso . "',( SELECT idAsignatura FROM asignatura WHERE nombreAsignatura='" . $listaAsignaturas[0] . "'))";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        }
    }
	
	function asignarAsignatura($idCurso, $idAsignatura) {
        $this->ConectarBD();

        $sql = "INSERT INTO asignatura_curso VALUES ('" . $idCurso . "','" . $idAsignatura . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        }
    }

    function desasignarAsignatura($idCurso, $nombreAsignatura) {
        $this->ConectarBD();
		$sql = "SELECT idAsignatura AS id FROM asignatura WHERE nombreAsignatura='" . $nombreAsignatura . "'";
		if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            $toret = $resultado->fetch_array();
            $idAsignatura = $toret['id'];
        }
        $sql = "DELETE FROM asignatura_curso WHERE idCurso='" . $idCurso . "' AND idAsignatura=" . $idAsignatura . "";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        }
    }

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