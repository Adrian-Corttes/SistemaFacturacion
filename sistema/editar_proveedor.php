<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}
include '../conexion.php';
if (isset($_POST['actualizar_proveedor'])) {
    $alert = "";
    if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = "<p class='msg_error'>Todos los Campos son Obligatorios</p>";
    } else {
        $idproveedor = $_POST['id'];
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        $consulta1 = "UPDATE proveedor SET proveedor ='$proveedor', contacto ='$contacto', telefono ='$telefono', direccion ='$direccion' WHERE codproveedor = '$idproveedor' ";
        $sql_update = mysqli_query($conexion, $consulta1);

        if ($sql_update) {
            $alert = "<p class='msg_save'>Proveedoe Actualizado Correctamente</p>";
        } else {
            $alert = "<p class='msg_error'>Error al Actualizar el Proveedor</p>";
        }
    }
}


//Mostrar los datos para modificar
if (empty($_REQUEST['id'])) {
    header('Location: lista_proveedor.php');
    mysqli_close($conexion);
}
$idproveedor = $_REQUEST['id'];
$consulta2 = "SELECT * FROM proveedor WHERE codproveedor = '$idproveedor' and estatus = 1 ";
$sql = mysqli_query($conexion, $consulta2);
mysqli_close($conexion);
$resul_sql = mysqli_num_rows($sql);

if ($resul_sql == 0) {
    header('Location: lista_proveedor.php');
} else {

    while ($data = mysqli_fetch_array($sql)) {

        $idproveedor = $data['codproveedor'];
        $proveedor = $data['proveedor'];
        $contacto = $data['contacto'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Actualizar Proveedores</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1><i class="fas fa-users-cog"></i> Actualizar Proveedor</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>

                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
                    <label for="proveedor">Proveedor</label>
                    <input type="text" name="proveedor" id="proveedor" placeholder= "Nombre del Proveedor" value="<?php echo $proveedor; ?>">

                    <label for="contacto">Contacto</label>
                    <input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto" value="<?php echo $contacto; ?>">

                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">

                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direccion; ?>">

                    <input type="submit" name="actualizar_proveedor" value="Actualizar Proveedor" class="btn_save">
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>




