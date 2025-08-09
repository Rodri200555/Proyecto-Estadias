<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "estadia";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT cajas, tarimas, piezas, paqueteria, tipo, usuario, 
               DATE(fecha_registro) AS fecha, 
               TIME(fecha_registro) AS hora 
        FROM registros_envio
        ORDER BY fecha_registro DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Envíos Registrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fb;
            padding: 30px;
            position: relative;
        }

        .btn-regresar {
            position: absolute;
            top: 20px;
            right: 30px;
            padding: 10px 20px;
            background-color: #2e5bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
        }

        table {
            width: 90%;
            margin: 60px auto 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #2e5bff;
            color: white;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<!-- Botón de Regresar -->
<a href="ver_responsables.html" class="btn-regresar">Regresar</a>
<!-- Botón Exportar a Excel -->
<a href="exportar_excel.php" class="btn-regresar" style="right: 170px; background-color: green;">Exportar Excel</a>


<h2>Facturas Registradas</h2>

<?php
if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>Cajas</th>
            <th>Tarimas</th>
            <th>Piezas</th>
            <th>Paquetería</th>
            <th>Tipo</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Hora</th>
          </tr>";
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$row['cajas']}</td>
                <td>{$row['tarimas']}</td>
                <td>{$row['piezas']}</td>
                <td>{$row['paqueteria']}</td>
                <td>{$row['tipo']}</td>
                <td>{$row['usuario']}</td>
                <td>{$row['fecha']}</td>
                <td>{$row['hora']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No hay envíos registrados.</p>";
}
$conn->close();
?>

</body>
</html>
