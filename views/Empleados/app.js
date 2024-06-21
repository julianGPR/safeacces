document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true, // Permitir edición
        selectable: true, // Permitir selección de días
        events: 'eventos.php', // Archivo que obtiene los eventos
        initialDate: '<?php echo date("Y-m-d"); ?>', // Fecha inicial del calendario
        // Función para manejar clics en los días
        dateClick: function(info) {
            abrirModal(info.dateStr); // Abrir modal para registrar evento
        }
    });

    calendar.render();

    // Función para abrir el modal de registro de evento
    function abrirModal(fecha) {
        document.getElementById('fecha-evento').value = fecha;
        document.getElementById('modal-evento').style.display = 'block';
    }

    // Cerrar el modal al hacer clic en la X
    document.getElementsByClassName('close')[0].onclick = function() {
        document.getElementById('modal-evento').style.display = 'none';
        document.getElementById('mensaje').innerHTML = '';
    };

    // Enviar datos del formulario al servidor
    document.getElementById('form-evento').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch('views/Empleados/registrar_evento.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('mensaje').innerHTML = data.message;
            if (data.success) {
                calendar.refetchEvents(); // Actualizar eventos en el calendario
                setTimeout(() => {
                    document.getElementById('modal-evento').style.display = 'none';
                    document.getElementById('mensaje').innerHTML = '';
                }, 2000); // Cerrar modal después de 2 segundos
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('mensaje').innerHTML = 'Error al registrar el evento.';
        });
    });
});
