<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "estadia";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Cabeceras para forzar descarga como Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=envios_registrados.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Consulta
$sql = "SELECT cajas, tarimas, piezas, paqueteria, tipo, usuario, 
               DATE(fecha_registro) AS fecha, 
               TIME(fecha_registro) AS hora 
        FROM registros_envio
        ORDER BY fecha_registro DESC";

$resultado = $conn->query($sql);

// Comienza el HTML con estilos embebidos
echo "
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th {
            background-color: #2E86C1;
            color: white;
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #0066ffff;
        }
    </style>
</head>
<body>
<h2 style='text-align:center;'>Reporte de Envíos Registrados</h2>
<table>
    <tr>
        <th>Cajas</th>
        <th>Tarimas</th>
        <th>Piezas</th>
        <th>Paquetería</th>
        <th>Tipo</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Hora</th>
    </tr>
";

// Imprimir filas
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

echo "</table>
</body>
</html>";

$conn->close();
?>
