<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location:index.php');
}else{
    if($_SESSION['usuario']=='ok'){
        $usuario=$_SESSION['nusuario'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/index.css">
    <title>Acceso ADministrador</title>
</head>
<body>
    <?php $URL="http://".$_SERVER['HTTP_HOST']."/impresoras3d-php"?>
<nav>
    <ul>
        <li><a href="<?php echo $URL;?>/administrador/home.php">estadisticas</a></li>
        <li><a href="<?php echo $URL?>/administrador/components/impresoras.php">Agregar Impresoras</a></li>
        <li><a href="#">Agregar Filamentos</a></li>
        <li><a href="<?php echo $URL;?>">Inicio de usuarios</a></li>
        <li><a href="<?php echo $URL?>/administrador/components/cerrar.php">Cerrar sesion</a></li>
    </ul>
</nav>