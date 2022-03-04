<?php
session_start();
if($_POST){
    if(($_POST['user']=='admin')&&($_POST['password']=='12345')){
        $_SESSION['usuario']='ok';
        $_SESSION['nusuario']=$_POST['user'];
        header('Location:home.php');
    }else{
        $mensaje="Usuario o Contrase;a incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section>
    <article>
        <form method="POST">
            <h1>Login</h1>
            <?php if(isset($mensaje)){
                ?> 
                <h1><?php echo $mensaje?></h1>
                <?php
            }?>
            <label>User</label>
            <input type="text" name='user' id='user' placeholder='Nombre del administrador'>
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder='Password'>
            <button type="submit">Ingresar</button>
        </form>
    </article>
</section>
</body>
</html>
