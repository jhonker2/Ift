document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth',
        initialDate: '2023-12-07',
        navLinks: true,
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true,
        editable: true,
        businessHours: true,
        droppable: true,
        drop: function(info) {
            if (document.getElementById('drop-remove').checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        datesSet: function(dateInfo) {
            var mes = dateInfo.start.getMonth() + 1;
            var anio = dateInfo.start.getFullYear();
            actualizarCalendario(anio, mes);
        },
        events: []
    });
    calendar.render();

    // Hacer que los eventos externos sean arrastrables
    var draggableEl = document.getElementById('external-events');
    new FullCalendar.Draggable(draggableEl, {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText
            };
        }
    });

    const toggleButton = document.querySelector('.toggle-icon');
    const navigation = document.querySelector('.sidebar-wrapper');
    const pageWrapper = document.querySelector('.page-wrapper');
    toggleButton.addEventListener('click', function () {
        navigation.classList.toggle('sidebar-hidden');
        pageWrapper.classList.toggle('sidebar-collapsed');
    });

    // ... (resto de los manejadores de eventos para 'toggle-cycles', 'toggle-cycles1', 'toggle-cycles2', etc.) ...
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
            start: item.dia
        };
    });
}
//Ciclo
document.getElementById('toggle-cycles').addEventListener('click', function() {
    var container = document.querySelector('.cycles-container');
    var icon = document.getElementById('toggle-cycles');
    if (container.style.display === 'none' || container.style.display === '') {
        container.style.display = 'block';
        icon.classList.add('open');
    } else {
        container.style.display = 'none';
        icon.classList.remove('open');
    }
});

//Ruta
document.getElementById('toggle-cycles1').addEventListener('click', function() {
    var container = document.querySelector('.cycles-container2');
    var icon = document.getElementById('toggle-cycles1');
    if (container.style.display === 'none' || container.style.display === '') {
        container.style.display = 'block';
        icon.classList.add('open');
    } else {
        container.style.display = 'none';
        icon.classList.remove('open');
    }
});

document.getElementById('toggle-cycles2').addEventListener('click', function() {
    var container = document.querySelector('.cycles-container3');
    var icon = document.getElementById('toggle-cycles2');
    if (container.style.display === 'none' || container.style.display === '') {
        container.style.display = 'block';
        icon.classList.add('open');
    } else {
        container.style.display = 'none';
        icon.classList.remove('open');
    }
});



document.getElementById('mySwitch').addEventListener('change', function() {
    if (this.checked) {
        console.log('Switch is ON');
        // Aquí puedes agregar más acciones para cuando el switch esté activado
    } else {
        console.log('Switch is OFF');
        // Aquí puedes agregar más acciones para cuando el switch esté desactivado
    }
});



$(function() {
	"use strict";
	new PerfectScrollbar(".app-container"),
	new PerfectScrollbar(".header-message-list"),
	new PerfectScrollbar(".header-notifications-list"),


	    $(".mobile-search-icon").on("click", function() {
			$(".search-bar").addClass("full-search-bar")
		}),

		$(".search-close").on("click", function() {
			$(".search-bar").removeClass("full-search-bar")
		}),

		$(".mobile-toggle-menu").on("click", function() {
			$(".wrapper").addClass("toggled")
		}),
		



		$(".dark-mode").on("click", function() {

			if($(".dark-mode-icon i").attr("class") == 'bx bx-sun') {
				$(".dark-mode-icon i").attr("class", "bx bx-moon");
				$("html").attr("class", "light-theme")
			} else {
				$(".dark-mode-icon i").attr("class", "bx bx-sun");
				$("html").attr("class", "dark-theme")
			}

		}), 

		
		$(".toggle-icon").click(function() {
			$(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
				$(".wrapper").addClass("sidebar-hovered")
			}, function() {
				$(".wrapper").removeClass("sidebar-hovered")
			}))
		}),
		$(document).ready(function() {
			$(window).on("scroll", function() {
				$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
			}), $(".back-to-top").on("click", function() {
				return $("html, body").animate({
					scrollTop: 0
				}, 600), !1
			})
		}),
		
		$(function() {
			for (var e = window.location, o = $(".metismenu li a").filter(function() {
					return this.href == e
				}).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
		}),
		
		
		$(function() {
			$("#menu").metisMenu()
		}), 
		
		$(".chat-toggle-btn").on("click", function() {
			$(".chat-wrapper").toggleClass("chat-toggled")
		}), $(".chat-toggle-btn-mobile").on("click", function() {
			$(".chat-wrapper").removeClass("chat-toggled")
		}),


		$(".email-toggle-btn").on("click", function() {
			$(".email-wrapper").toggleClass("email-toggled")
		}), $(".email-toggle-btn-mobile").on("click", function() {
			$(".email-wrapper").removeClass("email-toggled")
		}), $(".compose-mail-btn").on("click", function() {
			$(".compose-mail-popup").show()
		}), $(".compose-mail-close").on("click", function() {
			$(".compose-mail-popup").hide()
		}), 
		
		
		$(".switcher-btn").on("click", function() {
			$(".switcher-wrapper").toggleClass("switcher-toggled")
		}), $(".close-switcher").on("click", function() {
			$(".switcher-wrapper").removeClass("switcher-toggled")
		}), $("#lightmode").on("click", function() {
			$("html").attr("class", "light-theme")
		}), $("#darkmode").on("click", function() {
			$("html").attr("class", "dark-theme")
		}), $("#semidark").on("click", function() {
			$("html").attr("class", "semi-dark")
		}), $("#minimaltheme").on("click", function() {
			$("html").attr("class", "minimal-theme")
		}), $("#headercolor1").on("click", function() {
			$("html").addClass("color-header headercolor1"), $("html").removeClass("headercolor2 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
		}), $("#headercolor2").on("click", function() {
			$("html").addClass("color-header headercolor2"), $("html").removeClass("headercolor1 headercolor3 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
		}), $("#headercolor3").on("click", function() {
			$("html").addClass("color-header headercolor3"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor8")
		}), $("#headercolor4").on("click", function() {
			$("html").addClass("color-header headercolor4"), $("html").removeClass("headercolor1 headercolor2 headercolor3 headercolor5 headercolor6 headercolor7 headercolor8")
		}), $("#headercolor5").on("click", function() {
			$("html").addClass("color-header headercolor5"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor3 headercolor6 headercolor7 headercolor8")
		}), $("#headercolor6").on("click", function() {
			$("html").addClass("color-header headercolor6"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor3 headercolor7 headercolor8")
		}), $("#headercolor7").on("click", function() {
			$("html").addClass("color-header headercolor7"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor3 headercolor8")
		}), $("#headercolor8").on("click", function() {
			$("html").addClass("color-header headercolor8"), $("html").removeClass("headercolor1 headercolor2 headercolor4 headercolor5 headercolor6 headercolor7 headercolor3")
		})
		
	// sidebar colors 
	$('#sidebarcolor1').click(theme1);
	$('#sidebarcolor2').click(theme2);
	$('#sidebarcolor3').click(theme3);
	$('#sidebarcolor4').click(theme4);
	$('#sidebarcolor5').click(theme5);
	$('#sidebarcolor6').click(theme6);
	$('#sidebarcolor7').click(theme7);
	$('#sidebarcolor8').click(theme8);

	function theme1() {
		$('html').attr('class', 'color-sidebar sidebarcolor1');
	}

	function theme2() {
		$('html').attr('class', 'color-sidebar sidebarcolor2');
	}

	function theme3() {
		$('html').attr('class', 'color-sidebar sidebarcolor3');
	}

	function theme4() {
		$('html').attr('class', 'color-sidebar sidebarcolor4');
	}

	function theme5() {
		$('html').attr('class', 'color-sidebar sidebarcolor5');
	}

	function theme6() {
		$('html').attr('class', 'color-sidebar sidebarcolor6');
	}

	function theme7() {
		$('html').attr('class', 'color-sidebar sidebarcolor7');
	}

	function theme8() {
		$('html').attr('class', 'color-sidebar sidebarcolor8');
	}
	
	
});