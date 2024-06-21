<?php
require_once '../../config/db.php'; // Ajusta la ruta según tu estructura de archivos

// Verificar si se recibió un ID de evento válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de evento no proporcionado.');
}

// Obtener el ID del evento desde la URL
$id_evento = $_GET['id'];

// Conectar a la base de datos
$db = Database::connect();

// Consultar el evento específico por su ID
$query = "SELECT id_evento, evento, hora_inicio, hora_fin FROM t_eventos WHERE id_evento = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id_evento);
$stmt->execute();
$stmt->bind_result($id_evento, $evento, $hora_inicio, $hora_fin);
$stmt->fetch();
$stmt->close();

// Cerrar conexión a la base de datos
$db->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fefefe;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: grey;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 8px;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            background-color: grey;
            border: 1px solid black;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        .btn:hover {
            background-color: grey;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Editar Evento</h2>
    <form action="actualizar_evento.php" method="POST">
        <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">
        <label for="evento">Evento:</label>
        <input type="text" id="evento" name="evento" value="<?php echo htmlspecialchars($evento); ?>"><br><br>
        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="datetime-local" id="hora_inicio" name="hora_inicio" value="<?php echo date('Y-m-d\TH:i', strtotime($hora_inicio)); ?>"><br><br>
        <label for="hora_fin">Hora de Fin:</label>
        <input type="datetime-local" id="hora_fin" name="hora_fin" value="<?php echo date('Y-m-d\TH:i', strtotime($hora_fin)); ?>"><br><br>
        <input type="submit" value="Actualizar">
        <a href="listado_eventos.php" class="btn">Volver al Listado de Eventos</a>
    </form>

</body>
</html>
