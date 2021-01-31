<?php
session_start();

include '../conexion.php';
if(isset($_POST['guardar_cliente'])){
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = "<p class='msg_error'>Todos los Campos son Obligatorios</p>";
    } else {
        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];
        
        $result = 0;
        if(is_numeric($nit)){
            $consulta1 = "SELECT * FROM cliente WHERE nit = '$nit' ";
            $query = mysqli_query($conexion, $consulta1);
            $result = mysqli_fetch_array($query);
        }
        
        if ($result > 0) {
            $alert = "<p class='msg_error'>El Numero del NIT ya Existe.</p>";
        } else {
            $consulta2 = "INSERT INTO cliente (nit, nombre, telefono, direccion, usuario_id) VALUES ('$nit','$nombre','$telefono','$direccion','$usuario_id')";
            $query_insert = mysqli_query($conexion,$consulta2);
            if ($query_insert) {
                $alert = "<p class='msg_save'>¡ El cliente se a Registrado Correctamente !</p>";
            } else {
                $alert = "<p class='msg_error'>Error al Registrar el Cliente !</p>";
            }
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
        <title>Registro Cliente</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1><i class="fas fa-user-plus"></i> Registro de Clientes</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>

                <form action="" method="post">
                    <label for="nit">NIT</label>
                    <input type="number" name="nit" id="nit" placeholder="Numero de NIT">

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">

                    <label for="telefono">Telefono</label>
                    <input type="number" name="telefono" id="telefono" placeholder="Numero Telefonico">

                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion Completa">

                    <input type="submit" name="guardar_cliente" value="Guardar Cliente" class="btn_save">
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>

