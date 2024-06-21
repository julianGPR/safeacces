<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Eventos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f0f0f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 8px;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            background-color: grey;
            border: 1px solid #007bff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
    </style>
    <script>
        function confirmarEliminacion(idEvento) {
            if (confirm('¿Estás seguro de que quieres eliminar este evento?')) {
                // Redirigir o hacer una solicitud AJAX para eliminar el evento
                window.location.href = 'eliminar_evento.php?id=' + idEvento;
            }
        }
    </script>
</head>
<body>
    <h2>Listado de Eventos</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Evento</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conectar a la base de datos
            require_once '../../config/db.php';
            $db = Database::connect();

            // Consultar eventos
            $sql = "SELECT id_evento, evento, hora_inicio, hora_fin FROM t_eventos";
            $result = $db->query($sql);

            // Mostrar eventos en la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id_evento']}</td>";
                echo "<td>{$row['evento']}</td>";
                echo "<td>{$row['hora_inicio']}</td>";
                echo "<td>{$row['hora_fin']}</td>";
                echo "<td>";
                echo "<a href='editar_evento.php?id={$row['id_evento']}' class='btn'>Editar</a>";
                echo "<button onclick='confirmarEliminacion({$row['id_evento']})' class='btn btn-delete'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            }

            // Cerrar conexión a la base de datos
            $db->close();
            ?>
        </tbody>
    </table>

    <a href="calendario.php" class="btn">Volver al Calendario</a>
</body>
</html>
