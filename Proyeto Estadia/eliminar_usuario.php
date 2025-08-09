<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "estadia";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM usuarios3 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ver_usuarios.php"); // Redirige de nuevo
        exit;
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
} else {
    echo "ID no válido.";
}
$conn->close();
?>
