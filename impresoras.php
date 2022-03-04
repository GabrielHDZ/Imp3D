<?php include('components/header.php')?>

<?php
include('./administrador/config/conexiondb.php'); 
$datosTabla=$con->prepare("SELECT * FROM impresoras");
$datosTabla->execute();
$lista=$datosTabla->fetchAll(PDO::FETCH_ASSOC);
?>
<section>
    <article>
        <h1>Lista de los modelos disponibles con sus principales caracteristicas, ventajas y desvcentajas con las demas presentaciones</h1>
        <?php foreach ($lista as $key) {?>
        <article>
            <head><h1><?php echo $key['nombre']?></h1></head>
            <img src="./img/<?php echo $key['imagen']?>" alt="imagen de impresora">
        </article>
    <?php }?>
    </article>
</section>

<?php include("components/footer.php")?>