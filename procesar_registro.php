<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $curso = htmlspecialchars(trim($_POST['curso']));

    if (empty($nombre) || empty($correo) || empty($curso)) {
        die("Error: Todos los campos son obligatorios. <a href='principal.html'>Volver</a>");
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Error: Formato de correo inválido. <a href='principal.html'>Volver</a>");
    }

    try {
        $consulta = "INSERT INTO inscripciones (nombre_completo, correo_electronico, curso_seleccionado) 
                     VALUES (:nombre, :correo, :curso)";
        
        $sentencia = $conexion->prepare($consulta);
        
        // Asignamos parámetros
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':correo', $correo);
        $sentencia->bindParam(':curso', $curso);
        
        $sentencia->execute();
        
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registro Exitoso - Escuela Ofimática</title>
            <link rel="stylesheet" href="estilos.css">
            <style>
                .pantalla-exito {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    background-color: var(--color-fondo);
                }
                .tarjeta-exito {
                    background-color: var(--color-blanco);
                    padding: 50px;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                    text-align: center;
                    max-width: 500px;
                    width: 90%;
                }
                .icono-check {
                    font-size: 4rem;
                    color: #10b981;
                    margin-bottom: 20px;
                }
                .texto-resaltado {
                    color: var(--color-primario);
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="pantalla-exito">
                <div class="tarjeta-exito">
                    <div class="icono-check">✔</div>
                    <h2>¡Registro Exitoso!</h2>
                    <p>Gracias por inscribirte, <span class="texto-resaltado"><?php echo $nombre; ?></span>.</p>
                    <p>Tu lugar en el curso de <span class="texto-resaltado"><?php echo $curso; ?></span> está confirmado.</p>
                    <br>
                    <a href="principal.html" class="boton-principal">Volver al inicio</a>
                </div>
            </div>
        </body>
        </html>
        <?php
        
    } catch(PDOException $error) {
        echo "Error al registrar: " . $error->getMessage();
    }
} else {
    header("Location: principal.html");
    exit();
}
?>