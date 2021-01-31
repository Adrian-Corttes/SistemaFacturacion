<?php
session_start();
if($_SESSION['rol'] !=1){
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
            <h1><i class="fas fa-users"></i> Lista de Usuarios</h1>
            <a href="registro_usuario.php" class="btn_new"><i class="fas fa-user-tie"></i> Crear Usuario</a>
            <form action="buscar_usuario.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                <button type="submit"  class="btn_search"><i class="fas fa-search"></i></button>
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
                $consulta =  "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol= r.idrol WHERE estatus= 1 ";
                $query = mysqli_query($conexion,$consulta);
                mysqli_close($conexion);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $data["idusuario"]; ?></td>
                            <td><?php echo $data["nombre"]; ?></td>
                            <td><?php echo $data["correo"]; ?></td>
                            <td><?php echo $data["usuario"]; ?></td>
                            <td><?php echo $data["rol"]; ?></td>
                            <td>
                                <a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>"><i class="fas fa-cogs"></i> Editar</a>
                                <?php if ($data['idusuario'] != 1) { ?>
                                    <a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["idusuario"]; ?>"><i class="fas fa-trash-alt"></i> Eliminar</a>
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
 