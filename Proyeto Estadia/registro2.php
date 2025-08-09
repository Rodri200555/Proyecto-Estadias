<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding-top: 20px;
        }

        .top-bar {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            padding: 20px;
            box-sizing: border-box;
        }

        .btn-regresar {
            padding: 10px 20px;
            background-color: #2e5bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-regresar:hover {
            background-color: #244ac1;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input, select {
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 250px;
        }

        button {
            padding: 10px;
            width: 100%;
            background-color: #244ac1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .mensaje {
            margin-top: 10px;
            color: green;
        }

        .error {
            margin-top: 10px;
            color: red;
        }
    </style>
</head>
<body>

    <!-- Botón regresar -->
    <div class="top-bar">
        <a href="ver_usuarios.php" class="btn-regresar">Regresar</a>
    </div>

    <form method="POST" action="">
        <h2>Registro de Usuario</h2>
        <input type="text" name="nombre" placeholder="Nombre de usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <select name="rol" required>
            <option value="">Seleccionar rol</option>
            <option value="admin">Administrador</option>
            <option value="usuario">Usuario</option>
        </select>
        <button type="submit">Registrar</button>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Conexión
            $conn = new mysqli("localhost", "root", "", "estadia");

            if ($conn->connect_error) {
                die("<p class='error'>Error de conexión: " . $conn->connect_error . "</p>");
            }

            $nombre = $_POST['nombre'];
            $password = $_POST['password'];
            $rol = $_POST['rol'];

            // Validación básica
            if (empty($nombre) || empty($password) || empty($rol)) {
                echo "<p class='error'>Por favor, completa todos los campos.</p>";
            } else {
                // Encriptar la contraseña
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insertar usuario
                $stmt = $conn->prepare("INSERT INTO usuarios3 (nombre, password, rol) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nombre, $hashed_password, $rol);

                if ($stmt->execute()) {
                    echo "<p class='mensaje'>Usuario registrado correctamente.</p>";
                } else {
                    echo "<p class='error'>Error al registrar: " . $stmt->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
        }
        ?>
    </form>

</body>
</html>
