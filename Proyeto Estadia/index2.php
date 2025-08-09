<?php
session_start(); // ← importante
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Envío</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
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

        button[type="submit"] {
            padding: 15px;
            width: 100%;
            background-color: #2d6cdf;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 12px;
            font-size: 13px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #b02a37;
        }

        .mensaje {
            display: none;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

    <!-- Botón cerrar sesión -->
    <button type="button" class="logout-btn" onclick="confirmarCierreSesion()">Cerrar sesión</button>

    <!-- Formulario -->
    <form method="POST" action="guardar_envio2.php" id="formulario">
        <input type="hidden" name="factura_id" value="<?php echo isset($factura['id']) ? $factura['id'] : ''; ?>">

        <label>Cajas:</label>
        <input type="number" name="cajas" autocomplete="off">

        <label>Tarimas:</label>
        <input type="number" name="tarimas" autocomplete="off">

        <label>Piezas:</label>
        <input type="number" name="piezas" required autocomplete="off">

        <label>Paquetería:</label>
        <input type="text" name="paqueteria" required autocomplete="off">

        <label>Tipo:</label>
        <select name="tipo" required>
            <option value="">Seleccione tipo</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <button type="submit">Guardar e Imprimir</button>
    </form>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmarCierreSesion() {
            Swal.fire({
                title: '¿Cerrar sesión?',
                text: 'Tu sesión se cerrará.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cerrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }

        window.onload = function () {
            const inputs = document.querySelectorAll('#formulario input[type="number"], #formulario input[type="text"]');
            inputs.forEach(input => input.value = '');
        }
    </script>

</body>
</html>
