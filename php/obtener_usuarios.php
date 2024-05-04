<?php
$host = "localhost";
$usuario = "root";
$contrasena = "123456";
$base_datos = "usu";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT id, nombre, email FROM usuarios";
    $resultado = $conexion->query($sql);


    sleep(15);
    if ($resultado->num_rows > 0) {
        $usuarios = array();
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        echo json_encode($usuarios);
    } else {
        echo json_encode(array());
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT id, nombre, email FROM usuarios WHERE id=$id";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        echo json_encode($usuario);
    } else {
        echo json_encode(array());
    }
}

$conexion->close();
?>
