<?php
include_once'conexion.php';
session_start();
if($_POST){
    $usuario=$_POST["usuario"];
    $contras=$_POST["contra"];
    $buscar='SELECT * FROM personas WHERE nombre_usuario = ?';
    $sentencia=$bd->prepare($buscar);
    $sentencia->execute(array($usuario));
    $resultado=$sentencia->fetch();
    echo "<br>";
    if(!$resultado || $contras != $resultado['contrasena']){
        echo"Usuario/contraseña incorrecto";
    }
    else{
        $_SESSION["name"]=$usuario;
        $_SESSION["IDpersona"]=$resultado["IDpersona"];
        $buscar_id="SELECT * FROM usuarios WHERE IDpersona = ?";
        $sentencia2=$bd->prepare($buscar_id);
        $sentencia2->execute(array($resultado["IDpersona"]));
        $resultado2=$sentencia2->fetch();
        if($resultado2){
		  $_SESSION["ID"]=$resultado2["IDpersona"];
          header("location:inicio1.php");
        }
        $id_artist="SELECT * FROM artistas WHERE IDpersona = ?";
        $sentencia3=$bd->prepare($id_artist);
        $sentencia3->execute(array($resultado["IDpersona"]));
        $resultado3=$sentencia3->fetch();
        if($resultado3){
		  $_SESSION["ID"]=$resultado3["IDpersona"];
          header("location:inicio2.php");
        }
    }
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Poyofy </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="POYO.png" class="brand_logo" alt="Logo",  width="200" height="200">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form  method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="usuario" class="form-control input_user" value="" placeholder="nombre de usuario">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="contra" class="form-control input_pass" value="" placeholder="contrasena">
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button  type="submit" name="button" class="btn login_btn">Ingresar</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						No tienes cuenta? <a href="cual_cuenta.php" class="ml-2">Registrate!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>