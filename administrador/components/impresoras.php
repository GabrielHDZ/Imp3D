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
        //subida de imagenes al server
        $fecha=new DateTime();
        $nombreArchivo=($txtimage!="")?$fecha->getTimestamp()."_".$_FILES['imagen']['name'] :"imagen.jpg";
        $tmpimagen=$_FILES['imagen']["tmp_name"];
        if($tmpimagen!=""){
            move_uploaded_file($tmpimagen,"../../img/".$nombreArchivo);
        }
        $sentencia->bindParam(':imagen',$nombreArchivo);
        $sentencia->execute();        
        break;
    case "actualizar":
        $s=$con->prepare("UPDATE impresoras SET nombre=:nombre WHERE id=:id");
        $s->bindParam(':nombre',$txtNombre);
        $s->bindParam(':id',$txtId);
        $s->execute();
        if($txtimage!=""){
                
            $fecha=new DateTime();
            $nombreArchivo=($txtimage!="")?$fecha->getTimestamp()."_".$_FILES['imagen']['name'] :"imagen.jpg";
            $tmpImagen=$_FILES['imagen']['tmp_name'];
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            //borrar imagen del server
            $s=$con->prepare("SELECT imagen FROM impresoras where id=:id");
            $s->bindParam(':id',$txtId);
            $s->execute();
            $i=$s->fetch(PDO::FETCH_LAZY);
            if(isset($i['imagen'])&&($i["imagen"]!="imagen.jpg")){
                if(file_exists('../../img/'.$i['imagen'])){
                    unlink("../../img/".$i["imagen"]);
                }
            }



            $s=$con->prepare("UPDATE impresoras SET imagen=:imagen WHERE id=:id");
            $s->bindParam(':imagen',$nombreArchivo);
            $s->bindParam(':id',$txtId);
            $s->execute();
        }
        break;
    case "eliminar":
        header('Location:impresoras.php');
        break;
    case "seleccionar":
        $c=$con->prepare("SELECT * FROM impresoras WHERE id=:id");
        $c->bindParam(':id',$txtId);
        $c->execute();
        $seleccion=$c->fetch(PDO::FETCH_LAZY);
        $txtNombre=$seleccion['nombre'];
        $txtimage=$seleccion['imagen'];

        break;
    case "borrar":
        //borrar imagen del server
        $s=$con->prepare("SELECT imagen FROM impresoras where id=:id");
        $s->bindParam(':id',$txtId);
        $s->execute();
        $i=$s->fetch(PDO::FETCH_LAZY);
        if(isset($i['imagen'])&&($i["imagen"]!="imagen.jpg")){
            if(file_exists('../../img/'.$i['imagen'])){
                unlink("../../img/".$i["imagen"]);
            }
        }

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
            <input type="text" value="<?php echo $txtId?>" name="id" id="id" required readonly>

            <label>Nombre</label>
            <input type="text" value="<?php echo $txtNombre?>" name="nombre" id="nombre" placeholder="nombre de la impresora" required>

            <label>Imagen</label>
            value="<?php echo $txtimage?>"
            <input type="file" name="imagen" id="imagen">

            <button type="submit" name="accion" <?php echo($accion=="seleccionar")?"disabled":""?> value="agregar">Agregar</button>
            <button type="submit" name="accion" <?php echo($accion!="seleccionar")?"disabled":""?> value="actualizar">actualizar</button>
            <button type="submit" name="accion" <?php echo($accion!="seleccionar")?"disabled":""?> value="eliminar">Cancelar</button>
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
                    <td><img src="../../img/<?php echo $fila['imagen']?>" alt="Imagen de la impresora" style="width:220px;height:220px;"></td>
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