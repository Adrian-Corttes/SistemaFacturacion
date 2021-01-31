<?php    //Eliminar los datos
session_start();
if($_SESSION['rol'] !=1){
    header("location: ./");
}
 include '../conexion.php';
 
 if(isset($_POST['aceptar'])){
     $idusuario = $_POST['idusuario'];
     //$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario= $idusuario");
     $query_delete = mysqli_query($conexion,"UPDATE usuario SET estatus= 0 WHERE idusuario= $idusuario");
     mysqli_close($conexion);
     if($query_delete){
         header("location: lista_usuarios.php");
     } else {
         echo "Error al eliminar";
     }
 }
 //Recuperer los datos
if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1){
    header("location: lista_usuarios.php");
    mysqli_close($conexion);
} else {
    $idusuario = $_REQUEST['id'];
    $query = mysqli_query($conexion, "SELECT u.nombre, u.usuario, r.rol from usuario u INNER JOIN rol r on u.rol= r.idrol WHERE u.idusuario=$idusuario");
    mysqli_close($conexion);
    $result = mysqli_num_rows($query);
    
    if($result >0){
        while($data = mysqli_fetch_array($query)){
            $nombre = $data['nombre'];
            $usuario = $data['usuario'];
            $rol = $data['rol'];

        }
    } else {
         header("location: lista_usuarios.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Eliminar Usuario</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="data_delete">
                <h2>¿Esta seguro de eliminar el siguiente Registro?</h2>
                <p>Nombre: <span><?php echo $nombre; ?></span></p>
                <p>Usuario: <span><?php echo $usuario; ?></span></p>
                <p>Tipo Usuario: <span><?php echo $rol; ?></span></p>
                
                <form method="post" action="">
                    <input type="hidden" name="idusuario" value="<?php echo  $idusuario; ?>">
                    <a class="btn_cancel" href="lista_usuarios.php">Cancelar</a>
                    <input class="btn_ok" name="aceptar" type="submit" value="Aceptar">
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>

