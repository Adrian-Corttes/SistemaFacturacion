<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}
include '../conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Lista de Proveedores</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <h1><i class="fas fa-truck-moving"></i> Lista de Proveedores</h1>
            <a href="registro_proveedor.php" class="btn_new"><i class="fas fa-truck"></i> Crear Proveedor</a>
            <form action="buscar_proveedor.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">                
                <button type="submit"  class="btn_search"><i class="fas fa-search"></i></button>
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Proveedor</th>                    
                    <th>Contacto</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>                                        
                </tr>
                <?php
                $consulta = "SELECT * FROM proveedor WHERE estatus = 1 ORDER BY codproveedor ASC ";
                $query = mysqli_query($conexion, $consulta);
                mysqli_close($conexion);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $data["codproveedor"]; ?></td>
                            <td><?php echo $data["proveedor"]; ?></td>
                            <td><?php echo $data["contacto"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["direccion"]; ?></td>      
                            <td>
                                <a class="link_edit" href="editar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>"><i class="fas fa-cogs"></i> Editar</a>
                                <a class="link_delete" href="eliminar_confirmar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>"><i class="fas fa-trash-alt"></i> Eliminar</a>
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

