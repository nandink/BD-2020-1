<?php
include_once'conexion.php';

//AGREGAR A BASE DE DATOS

if ($_POST){
    $usuario = $_POST['nombre_usuario'];
    $correito = $_POST['correo'];
    $contra = $_POST['contrasena'];
    $insert_persona = 'INSERT INTO personas (nombre_usuario,contrasena,correo) VALUES (?,?,?)';
    $agregar = $bd->prepare($insert_persona);
    $agregar->execute(array($usuario,$contra,$correito));
    $crearuser="SELECT * FROM personas WHERE nombre_usuario = ?";
    $sentencia=$bd->prepare($crearuser);
    $sentencia->execute(array($usuario));
    $resultado=$sentencia->fetch();
    $sentencia=$bd->prepare($crearuser);
    $sentencia->execute(array($usuario));
    $resultado=$sentencia->fetch(); 
    $create_usuario='INSERT INTO artistas (IDpersona) VALUES (?)';
    $agregar_usuario= $bd->prepare($create_usuario);
    $agregar_usuario->execute(array($resultado["IDpersona"]));
}
?>
<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">
<div class="card bg-light">
<title>Registro </title>
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-4 text-center">Crear cuenta artística</h4>
	<form method="POST">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="nombre_usuario" class="form-control" placeholder="Nombre de usuario" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="correo" class="form-control" placeholder="Correo" type="email">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name= "contrasena" class="form-control" placeholder="Contraseña" type="password">
    </div> <!-- form-group// -->   
	<div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Crear cuenta  </button>
    </div> <!-- form-group// -->     
	<div class="mt-4">
					<div class="d-flex justify-content-center links">
					&nbsp;&nbsp;&nbsp;&nbsp; Ya tienes una cuenta? <a href="index.php">&nbsp;&nbsp;Ingresa aqui</a>
					</div>
				</div>        
    <div class="mt-4">
			    <div class="d-flex justify-content-center links">
					&nbsp;&nbsp;&nbsp;&nbsp; ¡Me equivoqué! <a href="cual_cuenta.php">&nbsp;&nbsp;Volver a escoger una cuenta</a>
					</div>
				</div>                                                                           
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
</html>
