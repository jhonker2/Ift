<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllersPlanificar;
use App\Http\Controllers\ControllersMonitoreo;
use App\Http\Controllers\ControllersCriticaLectura;
use App\Http\Controllers\ControllersReportesIndicadores;
use App\Http\Controllers\ControllersCobranza;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\SoaplecturaController;
use App\Http\Controllers\PlanificacionController;
use App\Http\Controllers\CrearProcesoController;



//Route::get('prueba', function () {return view('prueba');});

Route::get('Ruta', [ControllersPlanificar::class, 'rutas']);
Route::get('errores', [ControllersPlanificar::class, 'Errores']);



Route::get('mapa', [ControllersPlanificar::class, 'mapa']);
Route::get('obtenerNotificaciones', [ControllersPlanificar::class, 'obtenerNotificaciones']);


Route::get('/wilson', [ControllersPlanificar::class, 'wilson']);
    
Route::get('/obtenerCodigos_Ciclos', [SoapController::class, 'obtenerCodigos_Ciclos']);
Route::get('/obtenerInfoRuta/{ciclo}', [SoapController::class, 'obtenerInfoRuta']);
Route::get('/obtenerRuta/{ciclo}', [SoapController::class, 'obtenerCuentasPorRuta']);
//prueba
Route::get('/obtenerRuta2/{ciclo}', [SoapController::class, 'obtenerCuentasPorRutaprueba']);

Route::get('/rutasxcuenta/{ruta}', [SoapController::class, 'rutasxcuenta']);
Route::get('/rutasxcuentaPromedio/{ruta}/{observacion}', [SoapController::class, 'rutasxcuentaPromedio']);


Route::get('/procesarDatosRuta/{ruta}', [SoapController::class, 'procesarDatosRuta']);
Route::get('/rutasxcuentaXML/{ruta}', [SoapController::class, 'rutasxcuentaXML']);


Route::get('Cobranza/incio', [SoapController::class, 'reporteriaCobramza']);
Route::get('facturalogin', [SoapController::class, 'facturalogin']);
Route::get('getcontrol', [SoapController::class, 'getControlData']);
Route::get('getModeloOsi', [SoapController::class, 'getModeloOsi']);








//lectofacturacion
Route::get('getControlCuenta', [SoapController::class, 'getControlCuenta']);
Route::get('getcontrol', [SoapController::class, 'getControlData']);
Route::get('getModeloOsi', [SoapController::class, 'getModeloOsi']);
Route::get('/obtenerObservacion', [SoapController::class, 'obtenerObservacion']);
Route::get('/obtenerImpedimento', [SoapController::class, 'obtenerImpedimento']);
Route::get('/cc_x_rutas', [SoapController::class, 'cc_x_rutas']);
Route::get('/cc_x_rutasLecto2', [SoapController::class, 'cc_x_rutasLecto2']);
Route::get('/cuentasfull', [SoapController::class, 'cuentasfull']);



//Route::get('Lecto', [ControllersCobranza::class, 'cobranza']);





Route::get('Balances', [ControllersReportesIndicadores::class, 'balance']);
Route::get('Reportes', [ControllersReportesIndicadores::class, 'reporte']);
Route::get('Dashboards', [ControllersReportesIndicadores::class, 'dashboard']);
Route::get('/lectofactura', [SoapController::class, 'uploadAndProcessExcel'])->name('excel.process');
Route::post('/lectofactura', [SoapController::class, 'uploadAndProcessExcel'])->name('excel.upload');
Route::match(['get', 'post'], '/enviar_lectura/{lectura}', [SoapController::class, 'enviarLectura']);


Route::post('/obtenerClave', [PlanificacionController::class, 'obtenerClave'])->name('obtenerClave');

Route::post('controlLectura/app', [SoapController::class, 'sincronizarLecturas']);
Route::get('/datos/app', [SoapController::class, 'getControlData']);


Route::get('/error', function () {
    return view('Tramite.interfaces.error');
})->name('error');

//Route::get('navidad', function () {return view('login.navidad');});
//compromiso app
Route::get('loginle', function () {return view('login.loginlecto');});

Route::get('/callSoapApiD/{clave}', [SoapController::class, 'callSoapApiD'])->name('callSoapApiD');
Route::get('/getClave/{clave}', [SoapController::class, 'callSoapApi'])->name('callSoapApi');

Route::post('/loginlecto', [SoapController::class, 'autenticacionWeb2'])->name('autenticacionWeb2');

Route::get('facturas_datos', [ControllersMonitoreo::class, 'facturas_datos'])->name('facturas_datos');
Route::get('facturas_reales', [ControllersMonitoreo::class, 'facturas_reales'])->name('facturas_reales');

Route::get('reporteria', [ControllersMonitoreo::class, 'reporteria'])->name('reporteria');

Route::get('/dashboard', function () {
    return view('Tramite.dasboard');
})->name('dashboard');

Route::get('/index2', [PlanificacionController::class, 'index2'])->name('index2');


Route::post('/guardar_tarea', [CrearProcesoController::class, 'store'])->name('guardar_tarea');

// Asegúrate de tener una ruta que maneje la URL con el id_compromiso
Route::get('/proceso/{id_compromiso}', 'PlanificacionController@proceso');

Route::get('/guardar-proceso-en-sesion/{proceso}', [PlanificacionController::class, 'guardarProcesoEnSesion'])->name('guardarProcesoEnSesion');

// Rutas dentro de web.php
//bloqueo 
//Route::middleware(['blockeplani'])->group(function () {
    Route::get('facturas_datos', [ControllersMonitoreo::class, 'facturas_datos'])->name('facturas_datos');
//});
Route::middleware(['blocke'])->group(function () {
    Route::get('Lecto2', [ControllersCobranza::class, 'cobranza']);
    Route::get('facturas_datos', [ControllersMonitoreo::class, 'facturas_datos'])->name('facturas_datos');

    Route::get('facturamonitoreo', [ControllersMonitoreo::class, 'monitoreorutas']);

    Route::get('Monitoreo', [ControllersMonitoreo::class, 'personalCampo']);
Route::get('CriticaLectura', [ControllersCriticaLectura::class, 'criticaLectura']);
Route::get('Sesiones', [ControllersPlanificar::class, 'sesion']);
Route::get('SondeoE', [ControllersMonitoreo::class, 'SondeoE']);
Route::get('SondeoP', [ControllersMonitoreo::class, 'SondeoP']);
Route::get('php_info', [SoapController::class, 'php_info']);



/*CAMBIOS JHONY GUAMAN*/

Route::get('/get_total_ejecutas',[ControllersMonitoreo::class, 'get_ejecutadas']);
});

/***********/
/**SIGOP***/

Route::get('login',[PlanificacionController::class, 'login']);
Route::post('/loginingresar2', [SoapController::class, 'autenticacionWeb'])->name('autenticacionWeb');
Route::get('home', [PlanificacionController::class, 'index']);


Route::get('/mensajeria2', [PlanificacionController::class, 'mensajeria2'])->name('mensajeria2');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/mistramites', [PlanificacionController::class, 'mistramites'])->name('mistramites');; // Usa la sintaxis de array para referenciar el método del controlador

Route::get('/formulario/{id}', [PlanificacionController::class, 'showForm'])->name('showForm');
Route::get('/proceso2', [PlanificacionController::class, 'proceso2'])->name('proceso2');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/mensajeria', [PlanificacionController::class, 'mensajeria'])->name('mensajeria');; // Usa la sintaxis de array para referenciar el método del controlador


Route::get('/creartramite', [CrearProcesoController::class, 'create'])->name('creartramite');; // Usa la sintaxis de array para referenciar el método del controlador

Route::get('/fuente', [PlanificacionController::class, 'fuente'])->name('fuente');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/tareas', [PlanificacionController::class, 'tareas'])->name('tareas');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/notificaciones', [PlanificacionController::class, 'notificaciones'])->name('notificaciones');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/plantillanotificacion', [PlanificacionController::class, 'plantillanotificacion'])->name('plantillanotificacion');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/caminos', [PlanificacionController::class, 'caminos'])->name('caminos');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/entregable', [PlanificacionController::class, 'entregable'])->name('entregable');; // Usa la sintaxis de array para referenciar el método del controlador
Route::get('/get_empleados', [PlanificacionController::class, 'get_empleados'])->name('get_empleados');; // Usa la sintaxis de array para referenciar el método del controlador

Route::get('base', [PlanificacionController::class, 'base'])->name('base');



