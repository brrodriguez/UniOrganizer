<?php
//Realización del sign out
session_start();
session_destroy();
header('Location:../index.php');

?>
