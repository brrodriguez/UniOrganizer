<?php

//Gestión del acceso, login, selección de idioma
include '../Models/USUARIO_Model.php';
include '../Views/MENSAJE_Vista.php';

if (isset($_REQUEST['accion'])) {

    if ($_REQUEST['accion'] == 'Login') {
include '../css/header.php';
        $usuario = new USUARIO_Modelo($_REQUEST['username'], $_REQUEST['password'], '', '', '', '', '', '', '', '');
        $respuesta = $usuario->Login(); //Comprueba que se pueda loguear
        if ($respuesta == 'true') {
            session_start();
            $_SESSION['IDIOMA'] = $_REQUEST['IDIOMA']; //Establece el idioma de la sesión
            $_SESSION['login'] = $usuario->username; //Establece el login de la sesión
            $_SESSION['sesion'] = 0;
            
            header('Location:../index.php');
        } else {
            $_SESSION['IDIOMA'] = $_REQUEST['IDIOMA'];
            new Mensaje($respuesta, '../index.php');
        }
    }
}
?>
