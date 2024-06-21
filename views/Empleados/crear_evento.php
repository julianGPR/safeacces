<?php
// Verificar si la sesión ya está activa antes de iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Asegurar que la sesión esté iniciada y contenga el username
if (!isset($_SESSION['username'])) {
    die("Acceso no autorizado.");
}

// Obtener el documento del empleado de la variable de sesión
$documento_empleado = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #fff, #f1f1f1);
            color: #333;
            overflow-x: hidden;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px; /* Ancho máximo del formulario */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
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
        button[type="submit"],
        button[type="button"] {
            background-color: grey;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px; /* Espacio entre botones */
        }
        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="modal-content">
        <h2>Crear Nuevo Evento</h2>
        <form id="formCrearEvento">
            <label for="nombreEvento">Nombre del Evento:</label>
            <textarea id="nombreEvento" name="nombreEvento" rows="4" required></textarea><br><br>

            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="datetime-local" id="fechaInicio" name="fechaInicio" required><br><br>

            <label for="fechaFin">Fecha de Fin:</label>
            <input type="datetime-local" id="fechaFin" name="fechaFin" required><br><br>

            <button type="submit">Guardar Evento</button>
            <button type="button" onclick="goBack()">Atrás</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }

        document.getElementById("formCrearEvento").addEventListener("submit", function(event) {
            event.preventDefault();

            var nombreEvento = document.getElementById("nombreEvento").value;
            var fechaInicio = document.getElementById("fechaInicio").value;
            var fechaFin = document.getElementById("fechaFin").value;

            fetch('guardar_evento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    nombreEvento: nombreEvento,
                    fechaInicio: fechaInicio,
                    fechaFin: fechaFin
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Evento creado:', data);
                window.location.href = 'calendario.php'; // Redirigir al calendario
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
