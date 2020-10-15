<?php
include_once'conexion.php';
session_start();
if (isset($_POST['seguir'])){
  $clientid = $_POST['client'];
  if ($clientid != $_SESSION['ID']){
    $insert_seguir = 'INSERT INTO siguen (IDp1,IDp2) VALUES (?,?)';
    $agregar = $bd->prepare($insert_seguir);
    $agregar->execute(array($_SESSION['ID'], $clientid));
    echo "Has seguido a este usuario.";
  }
  else{
    echo "No puedes seguirte a ti mismo";
  }
}
elseif (isset($_POST['megusta'])){
  $buscauser="SELECT * FROM usuarios WHERE IDpersona = ?";
  $sent=$bd->prepare($buscauser);
  $sent->execute(array($_SESSION['ID']));
  $result=$sent->fetch();
  $song_id = $_POST['song'];
  $gustar = 'INSERT INTO gustan (IDusuario,IDcancion) VALUES (?,?)';
  $agregar2 = $bd->prepare($gustar);
  $agregar2->execute(array($result['IDusuario'], $song_id));
  echo "Le has dado like a esta canción";
}
elseif (isset($_POST['seguirpl'])){
  $play_id = $_POST['playid'];
  $seguirpl = 'INSERT INTO siguenpl (IDpersona,IDplaylist) VALUES (?,?)';
  $agregar3 = $bd->prepare($seguirpl);
  $agregar3->execute(array($_SESSION['ID'], $play_id));
  echo "Has seguido esta playlist";
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
    <h4><b> Usuario:
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
  <a href="#todotodo" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-search fa-fw w3-margin-right"></i>EXPLORAR</a>
    <a href="perfilusuario.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>PERFIL</a>
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
    <h1><b>¿Qué hay de nuevo?</b></h1>
    </div>
  </header>
  
  <!-- DISPLAY DE TODAS LAS CANCIONES-->
  <div class="w3-row-padding">
  <br></br>
  <h3><b>Canciones del momento</b></h3>
  <?php
        $sql2='SELECT * FROM canciones';
        $sentencia=$bd->prepare($sql2);
        $sentencia->execute();
        $resultado=$sentencia->fetchAll();

        foreach($resultado as $dato):
          $songid = $dato['IDcancion'];
      ?>
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/mountains.jpg" alt="" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b><?php echo $dato['nombre_cancion']?> </b></p>
        <p>Autor: <?php echo $dato['autor']?></p>
        <p>Duracion: <?php echo $dato['Duracion']?> minutos</p>
        <p>Genero: <?php echo $dato['Genero']?></p>
        
        <form method="POST">
          <input type='hidden' name='song' value="<?= $songid ?>">
          <input type='submit' class='btn btn-outline-primary' value ='Me gusta' name='megusta' id='megusta'></input>
        </form>
      </div>
    </div>
    <?php endforeach ?>
  </div>
  
<!-- DISPLAY DE TODAS LAS PLAYLISTS-->
<div class="w3-row-padding">
  <br></br>
  <h3><b>Playlists del momento</b></h3>
  <?php
        $sql2='SELECT * FROM playlist';
        $sentencia=$bd->prepare($sql2);
        $sentencia->execute();
        $resultado=$sentencia->fetchAll();

        foreach($resultado as $dato):
          $plid = $dato['IDplaylist'];
      ?>
    <div class="w3-third w3-container w3-margin-bottom">
      <div class="w3-container w3-white">
        <p><b><?php echo $dato['Nombre_playlist']?> </b></p>
        <p><b>Seguidores: <?php echo $dato['cant_seguidore']?> </b></p>

        <form method="POST">
          <input type='hidden' name='playid' value="<?= $plid ?>">
          <input type='submit' class='btn btn-outline-primary' value ='Seguir Playlist' name='seguirpl' id='seguirpl'></input>
        </form>
      </div>
    </div>
    <?php endforeach ?>
  </div>
<!-- DISPLAY DE TODAS LAS PERSONAS (POR AHORAAAA)-->
<div class="w3-row-padding">
  <br></br>
  <h3><b>A quién seguir</b></h3>
  <?php
        $sql2='SELECT * FROM personas';
        $sentencia=$bd->prepare($sql2);
        $sentencia->execute();
        $resultado=$sentencia->fetchAll();

        foreach($resultado as $dato):
          $clientid = $dato['IDpersona'];
      ?>
     <div class="w3-third w3-container w3-margin-bottom">
      <div class="w3-container w3-white">
        <p><b><?php 
          echo $dato['nombre_usuario'];?>
          <p> <?php echo $dato['cant_seguidores']?> seguidores</p>
          </b></p>
      
          <form method="POST">
          <input type='hidden' name='client' value="<?= $clientid ?>">
          <input type='submit' class='btn btn-outline-primary' value ='Seguir' name='seguir' id='seguir'></input>
        </form>
      </div>
    </div>
    <?php endforeach ?>
  </div>
  

 <!-- DISPLAY DE TODOS LOS ALBUMES-->
 <div class="w3-row-padding">
  <br></br>
  <h3><b>Albumes del momento</b></h3>
  <?php
        $sql2='SELECT * FROM albumes';
        $sentencia=$bd->prepare($sql2);
        $sentencia->execute();
        $resultado=$sentencia->fetchAll();

        foreach($resultado as $dato):
          $idalbun = $dato['IDalbum'];
      ?>
      <div class="w3-third w3-container-md w3-margin-bottom">
      <div class="w3-container-md w3-white">
        <p><b><?php echo $dato['Nombre_album']?> </b></p>
        <p>Numero canciones: <?php echo $dato['cant_canciones']?></p>
        <p>Artista: <?php echo $dato['Autor_album']?></p>
        <?php
         $sql3='SELECT * FROM canciones WHERE IDalbum = (?)';
         $sentencia2=$bd->prepare($sql3);
         $sentencia2->execute(array($idalbun));
         $resultado2=$sentencia2->fetchAll();
         echo "Canciones: ";
         foreach($resultado2 as $dato2):
          echo $dato2['nombre_cancion'];
           endforeach
        ?>

    </div>
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