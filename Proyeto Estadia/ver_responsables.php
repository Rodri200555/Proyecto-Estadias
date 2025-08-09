<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú UTT Tlaxcala</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 10px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-left img {
            height: 60px;
        }

        .navbar-right a {
            margin-left: 25px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-right a:hover {
            color: #2e5bff;
        }

        .content {
            padding: 40px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-left">
            <!-- Logos -->
            <img src="http://localhost/Proyeto%20Estadia/ver_responsables.php" alt="Tlaxcala Logo" height="60">
            <img src="https://uttlaxcala.edu.mx/images/logos/utt.png" alt="UTT Logo" height="60">
        </div>
        <div class="navbar-right">
            <!-- Enlaces -->
            <a href="inicio.html">Inicio</a>
            <a href="tablero.html">Tablero</a>
            <a href="cursos.html">Mis cursos</a>
        </div>
    </div>

    <div class="content">
        <h1>Bienvenido al Portal Educativo</h1>
        <p>Selecciona una opción del menú para continuar.</p>
    </div>

</body>
</html>
