<?php
require_once '../../config/db.php';

// Verificar que se recibió una solicitud POST con datos JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar que se recibieron los datos esperados
    if (isset($data['nombreEvento']) && isset($data['fechaInicio']) && isset($data['fechaFin'])) {
        $nombre_evento = $data['nombreEvento'];
        $hora_inicio = $data['fechaInicio']; // Aquí debes ajustar según la estructura de tu JSON
        $hora_fin = $data['fechaFin'];       // Aquí debes ajustar según la estructura de tu JSON

        try {
            // Conectar a la base de datos
            $db = Database::connect();

            // Preparar consulta para insertar evento
            $query = "INSERT INTO t_eventos (evento, hora_inicio, hora_fin) VALUES (?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param("sss", $nombre_evento, $hora_inicio, $hora_fin);
            $stmt->execute();

            // Verificar si se realizó la inserción correctamente
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Evento registrado correctamente.'];
            } else {
                $response = ['success' => false, 'message' => 'Error al registrar el evento.'];
            }

            // Cerrar declaración y conexión a la base de datos
            $stmt->close();
            $db->close();
        } catch (Exception $e) {
            $response = ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    } else {
        // Si no se recibieron los datos esperados
        $response = ['success' => false, 'message' => 'Datos incompletos.'];
    }
} else {
    // Si no se recibió una solicitud POST válida
    $response = ['success' => false, 'message' => 'Método no permitido.'];
}

// Devolver respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
