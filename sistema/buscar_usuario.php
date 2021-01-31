<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include '../conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Lista de Usuarios</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <?php
            $busqueda = strtolower($_REQUEST['busqueda']);
            if (empty($busqueda)) {
                header('location: lista_usuarios.php');
                mysqli_close($conexion);
            }
            ?>
            <h1>Lista de Usuarios</h1>
            <a href="registro_usuario.php" class="btn_new">Crear Usuario</a>

            <form action="buscar_usuario.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
                <input type="submit" value="Buscar" class="btn_search">
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>

                <?php
                $consulta = "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol= r.idrol "
                        . "WHERE (u.idusuario LIKE '%$busqueda%' OR u.nombre LIKE '%$busqueda%' OR u.correo LIKE '%$busqueda%' OR u.usuario LIKE '%$busqueda%' OR r.rol LIKE '%$busqueda%' ) AND estatus= 1 ORDER BY u.idusuario ASC ";
                $result = mysqli_query($conexion, $consulta);
                mysqli_close($conexion);
                if ($result) {
                    while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data["idusuario"]; ?></td>
                            <td><?php echo $data["nombre"]; ?></td>
                            <td><?php echo $data["correo"]; ?></td>
                            <td><?php echo $data["usuario"]; ?></td>
                            <td><?php echo $data["rol"]; ?></td>
                            <td>
                                <a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>">Editar</a>
                                <?php if ($data['idusuario'] != 1) { ?>
                                    <a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["idusuario"]; ?>">Eliminar</a>
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

