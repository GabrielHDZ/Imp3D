<?php include('../templates/header.php') ?>
<?php
$txtId=(isset($_POST['id']))?$_POST['id']:"";
$txtNombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$txtimage=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

echo$txtId.$txtNombre.$txtimage.$accion
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
                    <th>Opciones</th>
                </tr>
                
            </thead>
            <tbody>
                <tr>
                    <td>222</td>
                    <td>ender 3 pro</td>
                    <td>Editar/Borrar</td>
                </tr>
            </tbody>
        </table>
    </article>
</section>

<?php include('../templates/footer.php')?>