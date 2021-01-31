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
            <h1><i class="fas fa-users"></i> Lista de Clientes</h1>
            <a href="registro_cliente.php" class="btn_new"><i class="fas fa-user"></i> Crear Cliente</a>
            <form action="buscar_cliente.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                <button type="submit"  class="btn_search"><i class="fas fa-search"></i></button>
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
                $consulta = "SELECT * FROM cliente WHERE estatus = 1 ORDER BY idcliente ASC ";
                $query = mysqli_query($conexion, $consulta);
                mysqli_close($conexion);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        if ($data['nit'] == 0) {
                            $nit = 'C/F';
                        } else {
                            $nit = $data['nit'];
                        }
                        ?>
                        <tr>
                            <td><?php echo $data["idcliente"]; ?></td>
                            <td><?php echo $data["nit"]; ?></td>
                            <td><?php echo $data["nombre"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["direccion"]; ?></td>                            
                            <td>                                
                                <a class="link_edit" href="editar_cliente.php?id=<?php echo $data["idcliente"]; ?>"><i class="fas fa-cogs"></i> Editar</a>
                                <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
                                    <a class="link_delete" href="eliminar_confirmar_cliente.php?id=<?php echo $data["idcliente"]; ?>"><i class="fas fa-trash-alt"></i> Eliminar</a>
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

