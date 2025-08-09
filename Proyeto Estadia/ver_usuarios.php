<?php
// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "estadia";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los registros
$sql = "SELECT 
            id,
            nombre,
            rol,
            DATE(fecha_registro) AS fecha,
            TIME(fecha_registro) AS hora
        FROM usuarios3
        ORDER BY fecha_registro DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Registrados</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
        }

        th {
            background-color: #2e5bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f4f7;
        }

        tr:hover {
            background-color: #e0e7ff;
        }

        .acciones a {
            text-decoration: none;
            padding: 6px 10px;
            margin-right: 6px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .editar {
            background-color: #0040ffff;
        }

        .eliminar {
            background-color: #dc3545;
        }

        .top-bar {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #2e5bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #244ac1;
        }
    </style>
</head>
<body>

    <!-- Botones en la esquina superior derecha -->
    <div class="top-bar">
        <a href="registro2.php" class="btn">Registro</a>
        <a href="ver_responsables.html" class="btn">Regresar</a>
    </div>

    <h2>Usuarios Registrados</h2>

    <?php
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acciones</th>
              </tr>";
        
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['rol']) . "</td>";
            echo "<td>" . $fila['fecha'] . "</td>";
            echo "<td>" . $fila['hora'] . "</td>";
            echo "<td class='acciones'>
                    <a class='editar' href='editar_usuario.php?id=" . $fila['id'] . "'>Editar</a>
                    <a class='eliminar' data-id='" . $fila['id'] . "' href='#'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No hay usuarios registrados.</p>";
    }

    $conn->close();
    ?>

    <!-- Script para alerta de confirmación con SweetAlert2 -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarLinks = document.querySelectorAll(".eliminar");

        eliminarLinks.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault(); // Prevenir navegación inmediata

                const userId = this.getAttribute("data-id");

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará al usuario permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "eliminar_usuario.php?id=" + userId;
                    }
                });
            });
        });
    });
    </script>

</body>
</html>
