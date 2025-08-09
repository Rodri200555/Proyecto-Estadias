<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "estadia";
$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del usuario si se pasa el ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT nombre, rol FROM usuarios3 WHERE id = $id";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
}

// Actualizar usuario al enviar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $rol = $conn->real_escape_string($_POST['rol']);

    $sql = "UPDATE usuarios3 SET nombre = '$nombre', rol = '$rol' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ver_usuarios.php"); // Redirige a la lista principal
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f0f2f5;
        }

        form {
            width: 400px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        label, input, select {
            display: block;
            width: 100%;
            margin-bottom: 12px;
        }

        .btn {
            padding: 10px;
            background-color: #2e5bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            box-sizing: border-box;
        }

        .btn:hover {
            background-color: #244ac1;
        }

        .btn.cancelar {
            background-color: #c12424ff;
        }

        .btn.cancelar:hover {
            background-color: #c12424ff;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Editar Usuario</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

    <label>Rol:</label>
    <input type="text" name="rol" value="<?php echo htmlspecialchars($usuario['rol']); ?>" required>

    <button type="submit" class="btn">Guardar Cambios</button>
    <a href="ver_usuarios.php" class="btn cancelar">Cancelar</a>
</form>

</body>
</html>
