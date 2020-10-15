<?php
include_once'conexion.php';
session_start();


//AGREGAR A BASE DE DATOS
if ($_POST){
   $nombrepl = $_POST['nombreplay'];
   $cancioname = $_POST['cancioname'];
   $sql='SELECT * FROM playlist WHERE Nombre_playlist = (?)';
   $sentencia=$bd->prepare($sql);
   $sentencia->execute(array($nombrepl));
   $resultado=$sentencia->fetch();
   if (!$resultado){
       echo "No existe esa playlist";
   }
   else{
    $playid = $resultado['IDplaylist'];
    $sql2='SELECT * FROM canciones WHERE nombre_cancion = (?)';
    $sentencia2=$bd->prepare($sql2);
    $sentencia2->execute(array($cancioname));
    $resultado2=$sentencia2->fetch();
    if(!$resultado2){
        echo "No existe esa cancion :(";
    }
    else{
        $cancion_id = $resultado2['IDcancion'];
        $nombreautor = $_POST['autorsong'];
        $sql5='SELECT * FROM personas WHERE nombre_usuario = (?)';
        $sentencia5=$bd->prepare($sql5);
        $sentencia5->execute(array($nombreautor));
        $resultado5=$sentencia5->fetch();
        $id_Art = $resultado5['IDpersona'];

        $sql6='SELECT * FROM artistas WHERE IDpersona = (?)';
        $sentencia6=$bd->prepare($sql6);
        $sentencia6->execute(array($id_Art));
        $resultado6=$sentencia6->fetch();
        if(!$resultado6){
            echo "No existe ese artista con esa cancion";
        }
        else{
            $sql3='SELECT * FROM playlist WHERE (Nombre_playlist=?)  AND (IDpersona=?)';
            $sentencia3=$bd->prepare($sql3);
            $sentencia3->execute(array($nombrepl, $_SESSION["ID"]));
            $resultado3=$sentencia3->fetch();
            $sql4 = 'INSERT INTO contienen (IDplaylist, IDcancion) VALUES (?,?)';
            $sentencia4=$bd->prepare($sql4);
            $sentencia4->execute(array($playid,$cancion_id)); 
            echo "Insertada :)";
        }
    }
   
}
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
    $senten=$bd->prepare($sql);
    $senten->execute(array($_SESSION["name"]));
    $resultado=$senten->fetch();
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
    <h1><b>¿A qué playlist quieres agregarle canciones?</b></h1>
    </div>
  </header>
  <!-- First Photo Grid-->
  
  <div class="w3-row-padding">
    <div class="w3-third w3-container w3-margin-bottom justify-content-center">
      <img src="/w3images/mountains.jpg" alt="" style="width:500%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
      <form method="POST">
	<div class="form-group input-group">
        <input name="nombreplay" class="form-control" placeholder="Nombre de playlist" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
        <input name="cancioname" class="form-control" placeholder="Cancion" type="text">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
        <input name="autorsong" class="form-control" placeholder="Artista" type="text">
        </div> <!-- form-group// -->
	<div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Agregar  </button>
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