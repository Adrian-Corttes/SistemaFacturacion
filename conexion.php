<?php
$host= "localhost";
$user= "root";
$password= "";
$db= "sistema_facturacion";

$conexion= @mysqli_connect ($host,$user,$password,$db);

if(!$conexion){
    echo "Error en la conexion";
} else {
    echo "";
}



