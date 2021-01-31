<?php
 session_start();
if($_SESSION['rol'] !=1){
    header("location: ./");
}
include '../conexion.php';
if (isset($_POST['actualizar'])) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
        $alert = "<p class='msg_error'>Todos los Campos son Obligatorios</p>";
    } else {
        $idUsuario = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = $_POST['clave'];
        $rol = $_POST['rol'];

        $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE (usuario= '$user' AND idusuario != $idUsuario)"
                . "OR (correo= '$email' AND idusuario != $idUsuario) ");
        $result = mysqli_fetch_array($query);
        $result = count($result);

        if ($result > 0) {
            $alert = "<p class='msg_error'>El correo o el usuario ya existen.</p>";
        } else {
            if(empty($_POST['clave'])){
                $sql_update = mysqli_query($conexion," UPDATE usuario SET nombre= '$nombre', correo= '$email', usuario='$user', rol= '$rol' "
                        . "WHERE idusuario= '$idUsuario' " );
            } else {
                $sql_update = mysqli_query($conexion," UPDATE usuario SET nombre= '$nombre', correo= '$email', usuario='$user', clave='$clave', rol= '$rol'"
                        . "WHERE idusuario= '$idusuario' " );
            }
           
            if ($sql_update) {
                $alert = "<p class='msg_save'>Usuario Actualizado Correctamente</p>";
            } else {
                $alert = "<p class='msg_error'>Error al Actualizar el usuario</p>";
            }
        }
    }
}

//Mostrar los datos para modificar
if (empty($_REQUEST['id'])) {
    header('Location: lista_usuarios.php');
    mysqli_close($conexion);
}
$iduser = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, "
        . "(r.rol) as rol FROM usuario u INNER JOIN rol r on u.rol= r.idrol WHERE idusuario=$iduser and estatus = 1");
mysqli_close($conexion);
$resul_sql= mysqli_num_rows($sql);

if($resul_sql ==0){
    header('Location: lista_usuarios.php');
} else {
    $option = " ";
    while ($data= mysqli_fetch_array($sql)){
        
        $iduser = $data['idusuario'];
        $nombre = $data['nombre'];
        $correo = $data['correo'];
        $usuario = $data['usuario'];
        $idrol = $data['idrol'];
        $rol = $data['rol'];
        
        if ($idrol == 1) {
            $option = '<option value=" ' . $idrol . ' " select> ' . $rol . ' </option> ';
        } else if ($idrol == 2) {
            $option = '<option value=" ' . $idrol . ' " select> ' . $rol . ' </option> ';
        } else if ($idrol == 3) {
            $option = '<option value=" ' . $idrol . ' " select> ' . $rol . ' </option> ';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Actualizar Usuarios</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1>Actualizar Usuarios</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>

                <form action="" method="post">
                    
                    <input type="hidden" name="id" value="<?php echo $iduser;?>">

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre;?>">

                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $correo;?>">

                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre Usuario" value="<?php echo $usuario;?>">

                    <label for="clave">Clave</label>
                    <input type="password" name="clave" id="clave" placeholder="Clave de acceso" value="">

                    <label for="rol">Tipo Usuario</label>
                    <?php
                    include '../conexion.php';
                    $query_rol = mysqli_query($conexion, "SELECT * FROM rol");
                    mysqli_close($conexion);
                    $result_rol = mysqli_num_rows($query_rol);
                    ?>
                    <select name="rol" id="rol" class="notItemOne">
                        <?php
                        echo $option;
                        if ($result_rol > 0) {
                            while ($rol = mysqli_fetch_array($query_rol)) {
                                ?>
                                <option value = "<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                    <input type="submit" name="actualizar" value="Actualizar Usuario" class="btn_save">
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>


