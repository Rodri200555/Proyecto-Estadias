<?php
session_start();
// Evitar el almacenamiento en caché de la página
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input {
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 250px;
        }
        button {
            padding: 10px;
            width: 100%;
            background-color: #2d6cdf;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>

    <script>
        // Evitar que el usuario regrese con la flecha del navegador
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    </script>
</head>
<body>

<form method="POST" action="" autocomplete="off" id="loginForm">
    <h2>Iniciar Sesión</h2>
    <input type="text" name="nombre" placeholder="Nombre de usuario" required autocomplete="off">
    <input type="password" name="password" placeholder="Contraseña" required autocomplete="off">
    <button type="submit">Ingresar</button>

    <?php
    $mostrarResetScript = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Datos de conexión
        $conn = new mysqli("localhost", "root", "", "estadia");

        if ($conn->connect_error) {
            die("<p class='error'>Conexión fallida: " . $conn->connect_error . "</p>");
        }

        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        // Buscar usuario por nombre y obtener también el rol
        $stmt = $conn->prepare("SELECT password, rol FROM usuarios3 WHERE nombre = ?");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password, $rol);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Guardar sesión
                $_SESSION['usuario'] = $nombre;
                $_SESSION['rol'] = $rol;

                // Redireccionar dependiendo del rol
                if ($rol === "admin") {
                    header("Location: ver_responsables.html");
                    exit();
                } elseif ($rol === "usuario") {
                    header("Location: index2.php");
                    exit();
                } else {
                    echo "<p class='error'>Rol no reconocido.</p>";
                    $mostrarResetScript = true;
                }
            } else {
                echo "<p class='error'>Contraseña incorrecta</p>";
                $mostrarResetScript = true;
            }
        } else {
            echo "<p class='error'>Usuario no encontrado</p>";
            $mostrarResetScript = true;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</form>

<?php if ($mostrarResetScript): ?>
<script>
    // Limpiar campos después de mostrar mensaje de error
    document.getElementById('loginForm').reset();
</script>
<?php endif; ?>

</body>
</html>
