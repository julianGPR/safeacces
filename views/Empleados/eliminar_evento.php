<?php
// Verificar si el id del evento está presente en la URL
if (isset($_GET['id'])) {
    // Obtener el id del evento desde la URL
    $id_evento = $_GET['id'];

    // Conectar a la base de datos
    require_once '../../config/db.php'; // Ajusta la ruta según tu estructura de archivos
    $db = Database::connect();

    // Preparar la consulta SQL para eliminar el evento
    $query = "DELETE FROM t_eventos WHERE id_evento = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $id_evento);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>alert('Evento eliminado correctamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar el evento');</script>";
    }

    // Cerrar conexión a la base de datos
    $stmt->close();
    $db->close();

    // Redirigir de vuelta al listado de eventos
    echo "<script>window.location.href = 'listado_eventos.php';</script>";
} else {
    // Si no se proporciona el id del evento en la URL
    echo "<p>Evento no encontrado.</p>";
}
?>
