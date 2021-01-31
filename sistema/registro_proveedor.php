<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}
include '../conexion.php';
if (isset($_POST['guardar_proveedor'])) {
    $alert = "";
    if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = "<p class='msg_error'>Todos los Campos son Obligatorios</p>";
    } else {
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];

        $consulta = "INSERT INTO proveedor (proveedor, contacto, telefono, direccion, usuario_id) VALUES ('$proveedor','$contacto','$telefono','$direccion','$usuario_id')";
        $query_insert = mysqli_query ($conexion,$consulta);
        if ($query_insert) {
            $alert = "<p class='msg_save'>Proveedor Creado Correctamente</p>";
        } else {
            $alert = "<p class='msg_error'>Error al crear el Proveedor</p>";
        }
    }
    mysqli_close($conexion);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Registro Proveedor</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1><i class="fas fa-user-plus"></i> Registro Proveedor</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>

                <form action="" method="post">
                    <label for="proveedor">Proveedor</label>
                    <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor">

                    <label for="contacto">Contacto</label>
                    <input type="text" name="contacto" id="contacto" placeholder="Nombre del contacto">

                    <label for="telefono">Telefono</label>
                    <input type="number" name="telefono" id="telefono" placeholder="Numero Telefonico">

                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion Completa">

                    <input type="submit" name="guardar_proveedor" value="Guardar Proveedor" class="btn_save">
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>



