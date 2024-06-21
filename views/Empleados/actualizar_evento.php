<?php
require_once '../../config/db.php';

// Verificar si se recibieron datos POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $id_evento = $_POST['id_evento'];
    $nombre_evento = $_POST['evento'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];

    try {
        // Conectar a la base de datos
        $db = Database::connect();

        // Preparar consulta para actualizar evento
        $query = "UPDATE t_eventos SET evento = ?, hora_inicio = ?, hora_fin = ? WHERE id_evento = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssi", $nombre_evento, $hora_inicio, $hora_fin, $id_evento);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->affected_rows > 0) {
            $message = 'Evento actualizado correctamente.';
        } else {
            $message = 'Error al actualizar el evento.';
        }

        // Cerrar declaración y conexión a la base de datos
        $stmt->close();
        $db->close();
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }

    // Mostrar mensaje de éxito mediante JavaScript
    echo "<script>alert('$message'); window.location.href = 'listado_eventos.php';</script>";
} else {
    // Si no se recibieron datos POST, retornar un error
    $message = 'Método no permitido.';
    echo "<script>alert('$message'); window.location.href = 'listado_eventos.php';</script>";
}
?>
