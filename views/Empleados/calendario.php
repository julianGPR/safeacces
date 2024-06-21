<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Eventos</title>
    <!-- Incluir FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <!-- Incluir jQuery (necesario para FullCalendar) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Incluir Moment.js (necesario para FullCalendar) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Incluir FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f0f0f0;
        }
        .button-container {
            margin-bottom: 20px;
        }
        .button-container button {
            background-color: grey; /* Color de fondo */
            color: white; /* Color de texto */
            padding: 10px 20px; /* Padding (espacio interno) */
            border: none; /* Sin borde */
            cursor: pointer; /* Cambio de cursor al pasar por encima */
            font-size: 14px; /* Tamaño de fuente */
            margin-right: 10px; /* Margen derecho entre botones */
            border-radius: 4px; /* Borde redondeado */
        }
        .button-container button:hover {
            background-color: #333; /* Cambio de color al pasar por encima */
        }
        #calendar {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="button-container">
        <button onclick="openEventForm()">Crear Nuevo Evento</button>
        <button onclick="viewEventList()">Ver Listado de Eventos</button>
    </div>
    <div id="calendar"></div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                // Configuración de FullCalendar
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                // Obtener eventos desde un archivo PHP
                events: 'eventos.php' // Ruta al archivo que obtiene los eventos desde la base de datos
            });
        });

        function openEventForm() {
            // Redirigir al formulario para crear un nuevo evento
            window.location.href = 'crear_evento.php'; // Ruta al formulario de creación de eventos
        }

        function viewEventList() {
            window.location.href = 'listado_eventos.php';
        }
    </script>
</body>
</html>
