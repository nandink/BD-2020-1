<?php
include_once'conexion.php';
session_start();
?>
<!DOCTYPE html>
<html>
<title>Poyofy para artistas</title>
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
    <a href="#perfilartista.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-heart fa-fw w3-margin-right"></i>MI PERFIL</a> 
    <a href="perfilartista2.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-music fa-fw w3-margin-right"></i>MIS CREACIONES</a> 
    <a href="artistascrear.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus fa-fw w3-margin-right"></i>CREAR</a> 
    <a href="inicio2.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-arrow-left fa-fw w3-margin-right"></i>VOLVER A INICIO</a> 
    <a href="borrarcuentaartista.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-times fa-fw w3-margin-right"></i>ELIMINAR CUENTA</a>
    <a href="cerrar.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-times fa-fw w3-margin-right"></i>CERRAR SESIÓN</a>

  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="">
    <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h2><b>¡Bienvenido: <?php echo $_SESSION["name"]  ?>!</b></h2>
    </div>
  </header>
  <div id="playlist" class="w3-row-padding">
  <h3><b>Playlist que te gustan</b></h3>
  <?php
        $sql1='SELECT * FROM siguenpl WHERE IDpersona= (?)';
        $sentencia1=$bd->prepare($sql1);
        $sentencia1->execute(array($_SESSION['ID']));
        $resultado1=$sentencia1->fetchAll();
        if(!$resultado1){
          echo "No le has dado like a ninguna playlist :(";
        }
        foreach($resultado1 as $dato1):
        $sql2='SELECT * FROM playlist WHERE IDplaylist= (?)';
        $sentencia2=$bd->prepare($sql2);
        $sentencia2->execute(array($dato1['IDplaylist']));
        $resultado2=$sentencia2->fetchAll();
        foreach($resultado2 as $data2):
      ?>
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/mountains.jpg" alt="" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b><?php echo $data2['Nombre_playlist']?> </b></p>
        <p>Seguidores: <?php echo $data2['cant_seguidore']?></p>
      </div>
    </div>
    <?php endforeach ?>
    <?php endforeach ?>


    <br></br>
    <br></br>
    <br></br>

  <h3><b>A quienes sigues</b></h3>
  <?php
        $sql3='SELECT * FROM siguen where IDp1=(?)';
        $sentencia3=$bd->prepare($sql3);
        $sentencia3->execute(array($_SESSION["ID"]));
        $resultado3=$sentencia3->fetchAll();
        if (!$resultado3){
          echo "No has seguido a nadie :(";
        }

        foreach($resultado3 as $dato2):
          $sql5='SELECT * FROM personas WHERE IDpersona= (?)';
          $sentencia5=$bd->prepare($sql5);
          $sentencia5->execute(array($dato2['IDp2']));
          $resultado5=$sentencia5->fetchAll();
          foreach($resultado5 as $data5):
      ?>
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/mountains.jpg" alt="" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b><?php echo $data5['nombre_usuario']?> </b></p>
      </div>
    </div>
    <?php endforeach ?>
    <?php endforeach ?>

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