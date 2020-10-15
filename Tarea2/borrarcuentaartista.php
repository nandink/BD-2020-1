<?php
include_once'conexion.php';
session_start();
$buscar='DELETE FROM artistas WHERE IDpersona = ?';
$sentencia=$bd->prepare($buscar);
$sentencia->execute(array($_SESSION['ID']));
$buscar2='DELETE FROM personas WHERE IDpersona = ?';
$sentencia2=$bd->prepare($buscar2);
$sentencia2->execute(array($_SESSION['ID']));

$_SESSION = array();
session_destroy();
header("location:index.php");
?>
