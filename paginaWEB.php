<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['message']);

    // Definir los datos de la conexión a la base de datos
    $host = "localhost"; // Cambiar si usas otro host
    $usuario = "root";   // Cambiar según tu configuración
    $password = "";      // Cambiar según tu configuración
    $baseDatos = "vp_sport"; // Nombre de la base de datos

    // Conectar a la base de datos
    $conexion = new mysqli($host, $usuario, $password, $baseDatos);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL
    $stmt = $conexion->prepare("INSERT INTO datos (name, email, message) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();

    // Mostrar los datos procesados
    echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Mensaje: " . htmlspecialchars($mensaje);
}
?>