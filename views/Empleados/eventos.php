<?php
require_once '../../config/db.php'; // Ajusta la ruta según tu estructura de archivos

// Conectar a la base de datos
$db = Database::connect();

// Consultar eventos desde la base de datos
$query = "SELECT id_evento AS id, evento AS title, hora_inicio AS start, hora_fin AS end FROM t_eventos";
$result = $db->query($query);

// Preparar el array de eventos
$events = [];
while ($row = $result->fetch_assoc()) {
    // Ajustar las fechas según sea necesario para que coincidan con el formato esperado por FullCalendar
    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $row['start'],
        'end' => $row['end']
    ];
}

// Cerrar conexión a la base de datos
$db->close();

// Devolver los eventos como JSON
header('Content-Type: application/json');
echo json_encode($events);
?>
