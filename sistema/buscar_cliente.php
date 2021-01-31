<?php
session_start();
include '../conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Lista de Clientes</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <?php
            $busqueda = strtolower($_REQUEST['busqueda']);
            if (empty($busqueda)) {
                header('location: lista_clientes.php');
                mysqli_close($conexion);
            }
            ?>
            <h1>Lista de Clientes</h1>
            <a href="registro_cliente.php" class="btn_new">Crear cliente</a>

            <form action="buscar_cliente.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
                <input type="submit" value="Buscar" class="btn_search">
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nit</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </tr>

                <?php               
                $consulta = "SELECT * FROM cliente WHERE (idcliente LIKE '%$busqueda%' OR nit LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%') AND estatus= 1 ORDER BY idcliente ASC";
                $resultado = mysqli_query($conexion, $consulta);
                mysqli_close($conexion);
                $result = mysqli_num_rows($resultado);
                if ($result > 0) {
                    while ($data = mysqli_fetch_array($resultado)) {
                        ?>
                        <tr>
                            <td><?php echo $data["idcliente"]; ?></td>
                            <td><?php echo $data["nit"]; ?></td>
                            <td><?php echo $data["nombre"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["direccion"]; ?></td>
                            <td>
                                <a class="link_edit" href="editar_cliente.php?id=<?php echo $data["idcliente"]; ?>">Editar</a>
                                 <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){ ?>
                                <a class="link_delete" href="eliminar_confirmar_cliente.php?id=<?php echo $data["idcliente"]; ?>">Eliminar</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>

