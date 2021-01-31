<?php
session_start();
if($_SESSION['rol'] !=1 and $_SESSION['rol'] !=2){
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
            <?php
            $busqueda = strtolower($_REQUEST['busqueda']);
            if (empty($busqueda)) {
                header('location: lista_proveedor.php');
                mysqli_close($conexion);
            }
            ?>
            <h1>Lista de Proveedores</h1>
            <a href="registro_proveedor.php" class="btn_new">Crear Proveedor</a>

            <form action="buscar_proveedor.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
                <input type="submit" value="Buscar" class="btn_search">
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
                $consulta = "SELECT * FROM proveedor WHERE (codproveedor LIKE '%$busqueda%' OR proveedor LIKE '%$busqueda%' OR contacto LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%') AND estatus= 1 ORDER BY idcliente ASC";
                $query = mysqli_query($conexion, $consulta);
                mysqli_close($conexion);
                $result = mysqli_num_rows($query);
                if ($result>0){
                    while ($data = mysqli_fetch_array ($query)) {
                        ?>
                        <tr>
                            <td><?php echo $data["codproveedor"]; ?></td>
                            <td><?php echo $data["proveedor"]; ?></td>
                            <td><?php echo $data["contacto"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["direccion"]; ?></td>      
                            <td>
                                <a class="link_edit" href="editar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>">Editar</a>                                 
                                <a class="link_delete" href="eliminar_confirmar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>">Eliminar</a>                              
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

