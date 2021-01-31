<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}
include '../conexion.php';
if (isset($_POST['guardar_producto'])) {
    $alert = "";
    if (empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['cantidad'])) {
        $alert = "<p class='msg_error'>Todos los Campos son Obligatorios</p>";
    } else {
        $proveedor = $_POST['proveedor'];
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $usuario_id = $_SESSION['idUser'];

        $consulta1 = "INSERT INTO producto (descripcion, proveedor, precio, existencia,usuario_id) VALUES ('$producto', '$proveedor', '$precio', '$cantidad','$usuario_id' )";
        $query_insert = mysqli_query($conexion,$consulta1);
        if ($query_insert) {
            $alert = "<p class='msg_save'>Producto Ingresado Correctamente</p>";
        } else {
            $alert = "<p class='msg_error'>Error al Ingresar el Producto</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Registro Producto</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1> <i class="fas fa-cubes"></i>Registro de productos</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>

                <form action="" method="post">

                    <label for="proveedor">Proveedor</label>
                    <?php
                    $consulta2 = "SELECT codproveedor, proveedor FROM  proveedor WHERE estatus = 1 ORDER BY proveedor ASC  ";
                    $query_proveedor = mysqli_query($conexion, $consulta2);
                    $result = mysqli_num_rows($query_proveedor);
                    mysqli_close($conexion);
                    ?>
                    <select name="proveedor" id="proveedor">
                        <?php
                        if ($result > 0) {
                            while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                                ?>
                                <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                                <?php
                            }
                        }
                        ?>                       
                    </select>

                    <label for="producto">Producto</label>
                    <input type="text" name="producto" id="Producto" placeholder="Nombre del Producto">

                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" placeholder="Precio del Producto">

                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del Producto">

                    <input type="submit" name="guardar_producto" value="Guardar Producto" class="btn_save">

                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>




