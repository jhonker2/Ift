$(function() {
    "use strict";

    var chartOptions = {
        series: [{
            name: "Tramites",
            data: []
        }],
        chart: {
            type: 'area',
            stacked: false,
            height: 310,
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !0
            },
            dropShadow: {
                enabled: !0,
                top: 3,
                left: 14,
                blur: 4,
                opacity: .1
            }
        },
        stroke: {
            width: 5,
            curve: "smooth"
        },
        xaxis: {
            categories: []
        },
        title: {
            text: "Tramites mas de 10 Días",
            align: "left",
            style: {
                fontSize: "16px",
                color: "#666"
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "light",
                gradientToColors: ["#FF0000"],
                shadeIntensity: 1,
                type: "vertical",
                opacityFrom: .7,
                opacityTo: .2,
                stops: [0, 90, 100]
            }
        },
        markers: {
            size: 5,
            colors: ["#FF0000"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7
            }
        },
        dataLabels: {
            enabled: !1
        },
        colors: ["#FF0000"],
        grid: {
            show: true,
            borderColor: 'rgba(0, 0, 0, 0.15)',
            strokeDashArray: 4,
        }
    };

    // Initialize the chart once
    var chart = new ApexCharts(document.querySelector("#chart1"), chartOptions);
    chart.render();

    function updateChart(fromDate, toDate) {
        $.ajax({
            url: '/monitoreoAATT/dashboard/getaatt',
            method: 'GET',
            data: {
                fromDate: fromDate,
                toDate: toDate
            },
            success: function(data) {
                const months = data.map(item => `${item.Mes}-${item.Anio}`);
                const tramites = data.map(item => item.Total_Tramites_Mayor_10_Dias);
                
                // Update the chart data without reinitializing the chart
                chart.updateSeries([{
                    name: "Tramites",
                    data: tramites
                }]);
                chart.updateOptions({
                    xaxis: {
                        categories: months
                    }
                });
            }
        });
    }

    $('#inputFromDate, #inputToDate').change(function() {
        const fromDate = $('#inputFromDate').val();
        const toDate = $('#inputToDate').val();

        updateChart(fromDate, toDate);
    });

    //... (resto del código sin cambios)

// Initialize the chart with default or current dates
const currentDate = new Date();
const threeMonthsAgo = new Date(currentDate.getFullYear(), currentDate.getMonth() - 3, 1); // 0-based months: subtracting 2 will give us the first day 3 months ago

$('#inputFromDate').val(threeMonthsAgo.toISOString().split('T')[0]);
$('#inputToDate').val(currentDate.toISOString().split('T')[0]);

updateChart(threeMonthsAgo.toISOString().split('T')[0], currentDate.toISOString().split('T')[0]);

 
});

	e = {
		series: [{
			name: "Total Users",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#0d6efd"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#0d6efd"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#0d6efd"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart2"), e).render();
	e = {
		series: [{
			name: "Page Views",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#f41127"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#f41127"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#f41127"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart3"), e).render();
	e = {
		series: [{
			name: "Avg. Session Duration",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#12E031"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#12E031"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#12E031"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart4"), e).render();
	e = {
		series: [{
			name: "Bounce Rate",
			data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257]
		}],
		chart: {
			type: "bar",
			height: 65,
			toolbar: {
				show: !1
			},
			zoom: {
				enabled: !1
			},
			dropShadow: {
				enabled: !0,
				top: 3,
				left: 14,
				blur: 4,
				opacity: .12,
				color: "#ffb207"
			},
			sparkline: {
				enabled: !0
			}
		},
		markers: {
			size: 0,
			colors: ["#ffb207"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		plotOptions: {
			bar: {
				horizontal: !1,
				columnWidth: "30%",
				endingShape: "rounded"
			}
		},
		dataLabels: {
			enabled: !1
		},
		stroke: {
			show: !0,
			width: 0,
			curve: "smooth"
		},
		colors: ["#ffb207"],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			theme: "dark",
			fixed: {
				enabled: !1
			},
			x: {
				show: !1
			},
			y: {
				title: {
					formatter: function(e) {
						return ""
					}
				}
			},
			marker: {
				show: !1
			}
		}
	};
	new ApexCharts(document.querySelector("#chart5"), e).render(), 
	
	document.addEventListener('DOMContentLoaded', function() {
		Highcharts.chart("chart6", {
			chart: {
				height: 350,
				type: "column",
				styledMode: !0
			},
			credits: {
				enabled: !1
			},
			title: {
				text: "Trafico de Tramites, Septiembre 2023"
			},
			accessibility: {
				announceNewData: {
					enabled: !0
				}
			},
			xAxis: {
				type: "category"
			},
			yAxis: {
				title: {
					text: "Total Tramites"
				}
			},
			legend: {
				enabled: !1
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: !0,
						format: "{point.y:.1f}%"
					},
					grouping: true, // Group bars together
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> en total<br/>'
			},
			series: [{
				name: "Trafico Completado",
				colorByPoint: !0,
				data: [{
					name: "Completados",
					y: window.porcentajeFinalizados || 0,
					drilldown: "Completados"
				}, {
					name: "Mas de 10 Dias",
					y: window.porcentajeMayores10Dias || 0,
					drilldown: "Mas de 10 Dias"
				}, {
					name: "En Ejecucion",
					y: window.porcentajeEnEjecucion || 0,
					drilldown: "En Ejecucion"
				}]
			}],
			drilldown: {
				series: [
					// Aquí puedes agregar tus series de datos para el drilldown si las necesitas
				]
			}
		});
	});
	
	
	
	
	Highcharts.chart("chart7", {
		chart: {
			height: 350,
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: !1,
			type: "pie",
			styledMode: !0
		},
		credits: {
			enabled: !1
		},
		title: {
			text: "Sessiones Dispositivos"
		},
		subtitle: {
			text: "Porcentaje Cuadrillero"
		},
		tooltip: {
			pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
		},
		accessibility: {
			point: {
				valueSuffix: "%"
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: !0,
				cursor: "pointer",
				innerSize: 120,
				dataLabels: {
					enabled: !0,
					format: "<b>{point.name}</b>: {point.percentage:.1f} %"
				},
				showInLegend: !0
			}
		},
		series: [{
			name: "Cuadrilleros",
			colorByPoint: !0,
			data: [{
				name: "Aflow",
				y: 80
			}, {
				name: "Movil",
				y: 14
			}, {
				name: "Tablet",
				y: 6
			}]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					plotOptions: {
						pie: {
							innerSize: 140,
							dataLabels: {
								enabled: !1
							}
						}
					}
				}
			}]
		}
	})
	// Importa las funciones necesarias de Firebase y Mapbox
// Configuración de Firebase



