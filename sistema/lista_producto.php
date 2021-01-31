<?php
session_start();
include '../conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Lista de Productos</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <h1><i class="far fa-list-alt"></i> Lista de Productos</h1>
            <a href="registro_producto.php" class="btn_new"><i class="fas fa-box-open"></i> Registrar Producto</a>
            <form action="buscar_cliente.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                <button type="submit"  class="btn_search"><i class="fas fa-search"></i></button>
            </form>
            <table>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>                    
                    <th>Precio</th>
                    <th>Existencia</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>                                        
                </tr>
                <?php
                $consulta = "SELECT p.codproducto, p.descripcion, p.precio, p.existencia, pr.proveedor FROM producto p INNER JOIN proveedor pr "
                        . "ON p.proveedor = pr.codproveedor WHERE p.estatus = 1 ORDER BY p.codproducto ASC ";
                $query = mysqli_query($conexion, $consulta);
                mysqli_close($conexion);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {                        
                        ?>
                        <tr>
                            <td><?php echo $data["codproducto"]; ?></td>
                            <td><?php echo $data["descripcion"]; ?></td>
                            <td><?php echo $data["precio"]; ?></td>
                            <td><?php echo $data["existencia"]; ?></td>
                            <td><?php echo $data["proveedor"]; ?></td> 
                            <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){ ?>
                            <td>
                                <a class="link_edit" href="agregar_producto.php?id=<?php echo $data["codproducto"]; ?>"><i class="fas fa-plus"></i> Agregar</a>   
                                <a class="link_edit" href="editar_producto.php?id=<?php echo $data["codproducto"]; ?>"><i class="fas fa-cogs"></i> Editar</a>                                
                                <a class="link_delete" href="eliminar_confirmar_producto.php?id=<?php echo $data["codproducto"]; ?>"><i class="fas fa-trash-alt"></i> Eliminar</a>                                
                            </td>
                            <?php } ?>
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

