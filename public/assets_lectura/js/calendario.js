var calendar;  // Asegúrate de que 'calendar' esté definido apropiadamente en tu código

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        
        initialView: 'dayGridMonth',
        initialDate: '2023-09-12',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        editable: true,
        selectable: true,
        businessHours: true,
        dayMaxEvents: true, // allow "more" link when too many events
        droppable: true, // this allows things to be dropped onto the calendar
        drop: function(info) {
            // is the "remove after drop" checkbox checked?
            if (document.getElementById('drop-remove').checked) {
                // if so, remove the element from the "Draggable Events" list
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        datesSet: function(dateInfo) {
            // Extraer año y mes del rango actual del calendario
            var mes = dateInfo.start.getMonth() + 1; // getMonth() devuelve un índice basado en cero
            var anio = dateInfo.start.getFullYear();

            // Llamar a actualizarCalendario
            actualizarCalendario(anio, mes);
        },
        events: []  // Elimina los eventos estáticos
    });
    calendar.render();
});
function actualizarCalendario(anio, mes) {
    $.ajax({
        url: '/actualizarcalendario',
        method: 'POST',
        data: { anio: anio, mes: mes },
        success: function(data) {
            var eventos = convertirDatosACalendario(data);
            calendar.removeAllEvents();
            calendar.addEventSource(eventos);
        },
        error: function(error) {
            console.error('Error al actualizar el calendario:', error);
        }
    });
}
function convertirDatosACalendario(datos) {
    return datos.map(function(item) {
        return {
            title: 'Código: ' + item.codigo_ciclofacturacion,
            start: item.dia,  // Asegúrate de que 'item.dia' tenga formato 'YYYY-MM-DD'
            // Puedes agregar más propiedades aquí si necesitas
        };
    });
}
function convertirDatosACalendario(datos) {
    // Convertir los datos de tu base de datos a un formato que FullCalendar pueda entender
}

// Si deseas implementar arrastrar y soltar, necesitarás ajustar estas funciones
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}
