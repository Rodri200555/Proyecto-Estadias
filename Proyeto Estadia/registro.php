<?php
// Datos de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "estadia";

// Conectar a la base de datos
$conn = new mysqli($host, $usuario, $contrasena, $bd);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$password = $_POST['password'];

// Hashear la contraseña
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insertar en la base de datos
$sql = "INSERT INTO usuarios (nombre, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nombre, $password_hashed);

if ($stmt->execute()) {
    echo "Usuario registrado con éxito.";
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
