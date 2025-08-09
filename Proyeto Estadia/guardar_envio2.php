<?php
session_start();
date_default_timezone_set('America/Mexico_City');

$host = "localhost";
$user = "root";
$pass = "";
$db = "estadia";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$cajas = $_POST['cajas'] ?? 0;
$tarimas = $_POST['tarimas'] ?? 0;
$tipo = $_POST['tipo'];
$piezas = $_POST['piezas'] ?? 0;
$paqueteria = $_POST['paqueteria'] ?? 'No especificado';
$usuario = $_SESSION['usuario'] ?? 'desconocido';

$sql = "INSERT INTO registros_envio (cajas, tarimas, piezas, paqueteria, tipo, usuario, fecha_registro)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiisss", $cajas, $tarimas, $piezas, $paqueteria, $tipo, $usuario);

if ($stmt->execute()) {
    $mensaje = "Registro guardado correctamente.";
    $ejecutarImpresion = true;
} else {
    $mensaje = "Error al guardar: " . $conn->error;
    $ejecutarImpresion = false;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Registro</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .top-bar {
            width: 100%;
            padding: 15px 20px;
            display: flex;
            justify-content: flex-end;
            background-color: #f1f1f1;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .boton-regresar {
            padding: 10px 18px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .boton-regresar:hover {
            background-color: #0056b3;
        }
        .contenido {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .mensaje {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <a href="index2.php" class="boton-regresar">← Regresar</a>
    </div>
    <div class="contenido">
        <div class="mensaje"><?php echo $mensaje; ?></div>
    </div>

    <?php if ($ejecutarImpresion): ?>
        <script>
            window.onload = function () {
                window.print();
            };
        </script>
    <?php endif; ?>
</body>
</html>
