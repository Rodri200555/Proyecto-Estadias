<?php
session_start();

date_default_timezone_set('America/Mexico_City');

$conn = new mysqli("localhost", "root", "", "estadia");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$cajas = isset($_POST['cajas']) ? (int)$_POST['cajas'] : 0;
$tarimas = isset($_POST['tarimas']) ? (int)$_POST['tarimas'] : 0;
$piezas = isset($_POST['piezas']) ? (int)$_POST['piezas'] : 0;
$paqueteria = isset($_POST['paqueteria']) ? $_POST['paqueteria'] : 'No especificado';
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
$fecha_registro = date("Y-m-d H:i:s");

$stmt = $conn->prepare("
    INSERT INTO registros_envio 
    (cajas, tarimas, piezas, paqueteria, fecha_registro, usuario) 
    VALUES (?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("iiisss", $cajas, $tarimas, $piezas, $paqueteria, $fecha_registro, $usuario);

if ($stmt->execute()) {
    $mensaje = "Registro guardado correctamente.";
    echo "<script>window.print();</script>";
} else {
    $mensaje = "Error al guardar: " . $stmt->error;
}

$stmt->close();
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
</body>
</html>
