<?php
$alert = ' ';   
session_start();
if (!empty($_SESSION['active'])) {
    header('location: sistema/');
} else {
    if (isset($_POST['ingresar'])) {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = 'Ingrese su suario y su Contraseña';
        } else {
            require_once 'conexion.php';
            $user = $_POST['usuario'];
            $pass = $_POST['clave'];
            
            $consulta =  "SELECT * FROM usuario WHERE usuario= '$user' AND clave= '$pass' ";     
            $query = mysqli_query($conexion,$consulta);
            mysqli_close($conexion);
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = TRUE;
                $_SESSION['idUser'] = $data['idusuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['email'] = $data['correo'];
                $_SESSION['user'] = $data['usuario'];
                $_SESSION['rol'] = $data['rol'];

                header('location: sistema/');
            } else {
                $alert = "El usuario o la contraseña son Incorrectos";
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login /Modulo de ventas</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="icon" href="img/modulo_ventas.png">
    </head>
    <body>
        <section id="container">
            <form action="" method="post">
                <h3>Iniciar sesión</h3>    
                <img src="img/iniciar-sesion (2).png" alt="Login">

                <input type="text" name="usuario" placeholder="Usuario">
                <input type="password" name="clave" placeholder="Contraseña">
                
                <div class="alert"><?php echo isset($alert) ? $alert : " "; ?></div>
                
                <input type="submit" name="ingresar" value="INGRESAR">
            </form>
        </section>
    </body>
</html>
