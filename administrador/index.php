<?php
    if($_POST){
        header('Location:home.php');
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
