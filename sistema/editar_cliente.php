<?php
session_start();
include '../conexion.php';
if (isset($_POST['actualizar_cliente'])) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = "<p class='msg_error'>Todos los Campos son Obligatorios</p>";
    } else {
        $idcliente = $_POST['id'];
        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        $result = 0;

        if (is_numeric($nit) and $nit != 0) {
            $consulta1 = "SELECT * FROM cliente WHERE (nit ='$nit' and idcliente !='$idcliente')";
            $query = mysqli_query($conexion, $consulta1);
            $result = mysqli_fetch_array($query);
            $result = count($result);
        }

        if ($result > 0) {
            $alert = "<p class='msg_error'>El Nit ya existe, Ingrese otro.</p>";
        } else {
            if ($nit == " ") {
                $nit = 0;
            }
            $consulta2 = "UPDATE cliente SET nit =$nit, nombre ='$nombre', telefono ='$telefono', direccion ='$direccion' WHERE idcliente = $idcliente ";
            $sql_update = mysqli_query($conexion, $consulta2);

            if ($sql_update) {
                $alert = "<p class='msg_save'>Cliente Actualizado Correctamente</p>";
            } else {
                $alert = "<p class='msg_error'>Error al Actualizar el Cliente</p>";
            }
        }
    }
}

//Mostrar los datos para modificar
if (empty($_REQUEST['id'])) {
    header('Location: lista_clientes.php');
    mysqli_close($conexion);
}
$idcliente = $_REQUEST['id'];
$consulta3 = "SELECT * FROM cliente WHERE idcliente = '$idcliente' and estatus = 1 ";
$sql = mysqli_query($conexion, $consulta3);
mysqli_close($conexion);
$resul_sql = mysqli_num_rows($sql);

if ($resul_sql == 0) {
    header('Location: lista_clientes.php');
} else {

    while ($data = mysqli_fetch_array($sql)) {

        $idcliente = $data['idcliente'];
        $nit = $data['nit'];
        $nombre = $data['nombre'];
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
        <title>Actualizar Clientes</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1>Actualizar Clientes</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>

                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $idcliente; ?>">
                    <label for="nit">NIT</label>
                    <input type="text" name="nit" id="nit" placeholder="Numero de NIT" value="<?php echo $nit; ?>">

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">

                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Numero Telefonico" value="<?php echo $telefono; ?>">

                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion Completa" value="<?php echo $direccion; ?>">

                    <input type="submit" name="actualizar_cliente" value="Actualizar Cliente" class="btn_save">
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>




