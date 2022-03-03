<?php include('../templates/header.php') ?>
<?php
$txtId=(isset($_POST['id']))?$_POST['id']:"";
$txtNombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$txtimage=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include('../config/conexiondb.php');


switch($accion){
    case "agregar":
        $sentencia=$con->prepare("INSERT INTO impresoras(nombre,imagen) value(:nombre,:imagen);");
        $sentencia->bindParam(':nombre',$txtNombre);
        $sentencia->bindParam(':imagen',$txtimage);
        $sentencia->execute();        
        break;
    case "actualizar":
        
        break;
    case "eliminar":

        break;
    case "seleccionar":

        break;
    case "borrar":
        $sentenciaD=$con->prepare("DELETE FROM impresoras where id=:id");
        $sentenciaD->bindParam(':id',$txtId);
        $sentenciaD->execute();
        break;
}
$datosTabla=$con->prepare("SELECT * FROM impresoras");
$datosTabla->execute();
$lista=$datosTabla->fetchAll(PDO::FETCH_ASSOC);
?>
<section>
    <article>
        <form  method="post" enctype="multipart/form-data">
            <label>Identificador</label>
            <input type="text" name="id" id="id">

            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="nombre de la impresora">

            <label>Imagen</label>
            <input type="file" name="imagen" id="imagen">
            <button type="submit" name="accion" value="agregar">Agregar</button>
            <button type="submit" name="accion" value="actualizar">actualizar</button>
            <button type="submit" name="accion" value="eliminar">Eliminar</button>
        </form>
    </article>
    <article>
        <h1>Tabla de presentaciond de informacion</h1>
        <table>
            <thead>
                <tr>
                    <th>clave</th>
                    <th>impresora</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                </tr>
                
            </thead>
            <tbody>
                <?php foreach($lista as $fila){?>
                <tr>
                    <td><?php echo $fila['id'];?></td>
                    <td><?php echo $fila['nombre'];?></td>
                    <td><?php echo $fila['imagen'];?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $fila['id'];?>"/>
                            <input type="submit" name="accion" value="seleccionar"/>
                            <button type="submit" name="accion" value="borrar">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>

<?php include('../templates/footer.php')?>