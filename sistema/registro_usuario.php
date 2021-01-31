
<?php
session_start();
if($_SESSION['rol'] !=1){
    header("location: ./");
}
include '../conexion.php';
if (isset($_POST['crear_usuario'])) {
//if(!empty($_POST)){
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = "<p class='msg_error'>Todos los Campos son Obligatorios</p>";
    } else {
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = $_POST['clave'];
        $rol = $_POST['rol'];
        
        $consulta1 = "SELECT * FROM usuario WHERE usuario= '$user' OR correo= '$email' ";
        $query = mysqli_query ($conexion,$consulta1);
      
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = "<p class='msg_error'>El correo o el usuario ya existen.</p>";
        } else {
            $consulta2 =  "INSERT INTO usuario (nombre, correo, usuario, clave, rol) VALUES ('$nombre','$email','$user','$clave','$rol')";
            $query_insert = mysqli_query($conexion,$consulta2);
           
            if ($query_insert) {
                $alert = "<p class='msg_save'>Usuario Creado Correctamente</p>";
            } else {
                $alert = "<p class='msg_error'>Error al crear el usuario</p>";
                   mysqli_close ($conexion);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include 'include/scripts.php'; ?>
        <title>Registro Usuarios</title>
    </head>
    <body>
        <?php include 'include/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1><i class="fas fa-user-plus"></i> Registro de Usuarios</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>

                <form action="" method="post">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">

                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo Electronico">

                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre Usuario">

                    <label for="clave">Clave</label>
                    <input type="password" name="clave" id="clave" placeholder="Clave de acceso">

                    <label for="rol">Tipo Usuario</label>
                    <?php
                    $query_rol = mysqli_query($conexion, "SELECT * FROM rol");
                    mysqli_close($conexion);
                    $result_rol = mysqli_num_rows($query_rol);
                    ?>
                    <select name="rol" id="rol">
                        <?php
                        if ($result_rol > 0) {
                            while ($rol = mysqli_fetch_array($query_rol)) {
                                ?>
                                <option value = "<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                    <input type="submit" name="crear_usuario" value="Crear Usuario" class="btn_save">
                    
                </form>
            </div>
        </section>
        <?php include 'include/footer.php'; ?>
    </body>
</html>
