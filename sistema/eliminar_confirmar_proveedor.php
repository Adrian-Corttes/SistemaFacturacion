<?php    //Eliminar los datos
session_start();
if($_SESSION['rol'] !=1 and $_SESSION['rol'] !=2){
    header("location: ./");
}
 include '../conexion.php';
 
 if(isset($_POST['aceptar'])){
     if(empty($_POST['idproveedor'])){
         header("location: lista_proveedor.php");
         mysqli_close($conexion);
     }
     $idproveedor = $_POST['idproveedor'];
     //$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario= $idusuario");
     $consulta1 = "UPDATE proveedor SET estatus = 0 WHERE codproveedor = $idproveedor";
     $query_delete = mysqli_query($conexion,$consulta1);
     mysqli_close($conexion);
     if($query_delete){
         header("location: lista_proveedor.php");
     } else {
         echo "Error al eliminar";
     }
 }
 //Recuperer los datos
if(empty($_REQUEST['id'])){
    header("location: lista_proveedor.php");
    mysqli_close($conexion);
} else {
    $idproveedor = $_REQUEST['id'];
    $consulta2 = "SELECT * FROM proveedor WHERE codproveedor = $idproveedor ";
    $query = mysqli_query($conexion,$consulta2);
    mysqli_close($conexion);
    $result = mysqli_num_rows($query);
    
    if($result >0){
        while($data = mysqli_fetch_array($query)){
                       $proveedor = $data['proveedor'];          
        }
    } else {
         header("location: lista_proveedor.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Eliminar Proveedor</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="data_delete">
                <h2>¿Esta seguro de eliminar el siguiente Registro?</h2>               
                <p>Nombre del Proveedor: <span><?php echo $proveedor; ?></span></p>                
                
                <form method="post" action="">
                    <input type="hidden" name="idproveedor" value="<?php echo  $idproveedor; ?>">
                    <a class="btn_cancel" href="lista_proveedor.php">Cancelar</a>
                    <input class="btn_ok" name="aceptar" type="submit" value="Aceptar">
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>



