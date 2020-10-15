<?php
include_once'conexion.php';
session_start();


//AGREGAR A BASE DE DATOS
if ($_POST){
    $buscar_user="SELECT * FROM usuarios WHERE IDpersona = ?";
    $sql_user=$bd->prepare($buscar_user);
    $sql_user->execute(array($_SESSION['ID']));
    $resultado=$sql_user->fetch();
    $nombre_playli = $_POST["nombre_play"];
    $insert_play = 'INSERT INTO playlist (IDusuario,IDpersona, Nombre_playlist,cant_seguidore) VALUES (?,?,?,?)';
    $agregarp = $bd->prepare($insert_play);
    $agregarp->execute(array($resultado['IDusuario'], $_SESSION['ID'],$nombre_playli,0));
    echo 'Playlist creada!';
}
?>
<!DOCTYPE html>
<html>
<title>Poyofy</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="POYO.png" type="image/x-icon" />
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <img src="POYO.png" style="width:45%;" class="w3-round"><br><br>
    <h4><b> Perfil:
    <?php
    $sql='SELECT * FROM personas WHERE nombre_usuario = ?';
    $sentencia=$bd->prepare($sql);
    $sentencia->execute(array($_SESSION["name"]));
    $resultado=$sentencia->fetch();
    echo($resultado['nombre_usuario']);
    ?>
    </b></h4>
  </div>
  <div class="w3-bar-block">
    <a href="inicio1.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-arrow-left fa-fw w3-margin-right"></i>VOLVER A INICIO</a>
    <a href="perfilusuario.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-arrow-left fa-fw w3-margin-right"></i>VOLVER A MI PERFIL</a> 
    <a href="cerrar.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-times fa-fw w3-margin-right"></i>CERRAR SESIÓN</a>

  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="todotodo">
    <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>¿Qué playlist crearás hoy?</b></h1>
    </div>
  </header>
  <!-- First Photo Grid-->
  <div class="w3-row-padding">
    <div class="w3-third w3-container w3-margin-bottom justify-content-center">
      <img src="/w3images/mountains.jpg" alt="" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
      <form method="POST">
	<div class="form-group input-group justify-content-center">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-music"></i> </span>
		 </div>
        <input name="nombre_play" class="form-control" placeholder="Nombre de playlist" type="text">
    </div> <!-- form-group// -->
	<div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Crear playlist  </button>
    </div> <!-- form-group// -->     
      </div>
    </div>
  </div>

  
<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>