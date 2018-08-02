<?php

//-------------------------------------------------------
include '../Functions/LibraryFunctions.php';

class CALENDARIO_Model {

//Parámetros de la clase calendario
    var $idCalendario;
    var $username;
    var $mysqli;

    function __construct($idCalendario, $username) {
        $this->idCalendario = $idCalendario;
        $this->username = $username;
    }

//Función para conectarnos a la Base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "root", "", "uniorganizer");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//Insertar calendario
    function Insertar() {
        $this->ConectarBD();
        $sql = "SELECT * FROM calendario WHERE idCalendario = '" . $this->idCalendario . "'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return 'El calendario ya existe en la base de datos';
        } else {
            
                $sql2 = "INSERT INTO calendario ( username ) VALUES ('" . $this->username . "'')";
                $this->mysqli->query($sql2);

                return 'Calendario añadido con exito';
                    
                }
            }
        }
    }

    //Funcion para dar de baja un calendario en el sistema.
    function Borrar() {
        $this->ConectarBD();
        $sql = "SELECT * FROM calendario WHERE idCalendario = '" . $this->idCalendario . "'";

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else if ($resultado->num_rows == 0) {
            return 'No se puede borrar porque no existe ese calendario';
        } else {
            $sql = "DELETE FROM calendario WHERE idCalendario='" . $this->idCalendario . "'";
            $this->mysqli->query($sql);

            return "El calendario fue borrado con exito";
        }
    }

    function Listar() {

        $this->ConectarBD();
        $sql = "SELECT * FROM calendario";
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

    //Funcion para ver una calendario en detalle, es decir, con todos los campos.
    function VerDetalle() {
        $this->ConectarBD();
        $sql = "SELECT * FROM calendario WHERE idCalendario ='" . $this->idCalendario . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

    //Devuelve los valores almacenados para una determinada calendario para posteriormente rellenar un formulario
    function RellenaDatos() {
        $this->ConectarBD();
        $sql = "SELECT * FROM calendario WHERE calendario.idCalendario = '" . $this->idCalendario . "'";

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

}

?>
