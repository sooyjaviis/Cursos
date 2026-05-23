<?php
$servidor = "localhost";
$base_datos = "cursos";
$usuario = "root";
$contrasena = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos;charset=utf8", $usuario, $contrasena);
    
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $error) {
    die("Error en la conexión a la base de datos: " . $error->getMessage());
}
?>