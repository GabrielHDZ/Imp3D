<?php
    $host='localhost';
    $db='sitioimpresoras';
    $user='root';
    $pass='';
    
    try {
        $con=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        if($con){echo "conexion establecida";}
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>