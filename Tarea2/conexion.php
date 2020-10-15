<?php
$user = 'root';
$pass = '';
$link = 'mysql:host=localhost;dbname=poyofydb';
try{
    $bd = new PDO($link, $user, $pass);
}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>