<?php

include_once '../Functions/LibraryFunctions.php';

class ASIGNATURA_Model {

//Parámetros de la clase Asignatura
	var $idAsignatura;
    var $nombreAsignatura;

    function __construct($idAsignatura, $nombreAsignatura) {
        $this->idAsignatura = $idAsignatura;
		$this->nombreAsignatura = $nombreAsignatura;
    }

//Función para conectarnos a la Base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "root", "", "uniorganizer");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//Devuelve una lista de todas las asignaturas
    function Listar() {
        $this->ConectarBD();
        $sql = "SELECT * FROM asignatura";
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
	
//Devuelve una lista de las asignaturas del usuario
    function ListarAsignaturasUsuario() {
        $this->ConectarBD();
        $sql = "SELECT * FROM asignatura A, asignatura_curso B, curso C WHERE A.idAsignatura=B.idAsignatura AND B.idCurso=C.idCurso AND C.idCalendario='" . $_SESSION['calendario'] . "'";
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

//Elimina una asignatura del sistema
    function Borrar($id) {
        $this->ConectarBD();
        $sql = "DELETE FROM asignatura WHERE idAsignatura='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return true;
        }
    }

//Inserta una nueva asignatura en el sistema
    function Insertar() {
        $this->ConectarBD();
        $sql = "INSERT INTO `asignatura`(`nombreAsignatura`) VALUES ('" . $this->nombreAsignatura . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return true;
        }
    }
	
//Devuelve los datos de una asignatura
    function Ver($id) {
        $this->ConectarBD();
        $sql = "SELECT * FROM asignatura WHERE idAsignatura='" . $id . "'";
        if (($resultado = $this->mysqli->query($sql))) {
            $result = $resultado->fetch_array();
            return $result;
        } else {
            return 'Error en la consulta sobre la base de datos.';
        }
    }
}

?>