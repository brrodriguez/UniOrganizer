<?php

include_once '../Functions/LibraryFunctions.php';

class ASIGNATURA_Model {

	var $idAsignatura;
    var $nombreAsignatura;
    var $descripcionAsignatura;

    function __construct($idAsignatura, $nombreAsignatura, $descripcionAsignatura) {
        $this->idAsignatura = $idAsignatura;
		$this->nombreAsignatura = $nombreAsignatura;
        $this->descripcionAsignatura = $descripcionAsignatura;
    }

    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "root", "", "uniorganizer");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

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

    function Borrar($id) {
        $this->ConectarBD();
        $sql = "DELETE FROM asignatura WHERE idAsignatura='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return true;
        }
    }

    function Insertar() {
        $this->ConectarBD();
        $sql = "INSERT INTO `asignatura`(`nombreAsignatura`, `descripcionAsignatura`) VALUES ('" . $this->nombreAsignatura . "','" . $this->descripcionAsignatura . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return true;
        }
    }

    function Ver($id) {
        $this->ConectarBD();
        $sql = "SELECT * FROM asignatura WHERE idAsignatura='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return $resultado->fetch_array();
        }
    }

    function Modificar($id) {
        $this->ConectarBD();
        $sql = "UPDATE asignatura SET nombreAsignatura='" . $this->nombreAsignatura . "',descripcionAsignatura='" . $this->descripcionAsignatura . "' WHERE idAsignatura='" . $id . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos.';
        } else {
            return true;
        }
    }

}

?>