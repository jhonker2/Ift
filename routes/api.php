<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\ControllersMonitoreo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllersPlanificar; // Aseg�rate de que el espacio de nombres sea correcto
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/sincronizar-lecturas', [ControllersPlanificar::class, 'sincronizarLecturas']);
Route::post('/insertarLecturaprueba', [ControllersPlanificar::class, 'insertarLecturaprueba']);
Route::get('/obtenerTodasLasLecturas', [ControllersPlanificar::class, 'obtenerTodasLasLecturas']);

//lectofacturacion
Route::post('SubirArchivoFac', [SoapController::class, 'uploaddata']);
Route::post('SubirFileLect', [SoapController::class, 'subir_foto_lectura_dev']);
//principal
Route::post('enviarFacturaLecto', [SoapController::class, 'sincronizarLecturasSoap'])->name('sincronizarLecturasSoap');
Route::post('enviarFacturaImprimir', [SoapController::class, 'enviarFacturaImprimir'])->name('enviarFacturaImprimir');

Route::post('enviarFacturaLecto2', [SoapController::class, 'sincronizarLecturasSoap2'])->name('sincronizarLecturasSoap2');
Route::post('soapwrite', [SoapController::class, 'soapwrite'])->name('soapwrite');

Route::get('getTotales', [SoapController::class, 'getTotales']);
Route::get('download/{numeroCuenta}', [ControllersMonitoreo::class, 'downloadFile']);
Route::get('downloadFoto/{numeroCuenta}', [ControllersMonitoreo::class, 'downloadFoto']);
Route::get('contarFotosSubidas', [ControllersMonitoreo::class, 'contarFotosSubidas']);

Route::get('getcuadrilleros', [ControllersMonitoreo::class, 'ID_CUADRILLEROS']);
Route::get('getMapboxToken', [ControllersMonitoreo::class, 'getMapboxToken']);
Route::get('getMapboxstyle', [ControllersMonitoreo::class, 'getMapboxstyle']);

Route::post('/ejecutarDesrutal', [ControllersMonitoreo::class, 'ejecutarDesrutal']);

Route::post('/enviarLecturas2', [ControllersMonitoreo::class, 'enviarLecturas2']);
Route::post('enviarLecturasC/{numeroCuenta}', [ControllersMonitoreo::class, 'enviarLecturasC']);

Route::post('/anular-tramites', [ControllersMonitoreo::class, 'anularTramites'])->name('anularTramites');

Route::post('/get_datos_d/{ruta}/{id_recorrido}/{cronograma}', [ControllersMonitoreo::class, 'get_datos_d'])->name('get_datos_d');

Route::post('/enviarLecturas', [ControllersMonitoreo::class, 'enviarLecturas']);
Route::post('/enviarLecturasT', [ControllersMonitoreo::class, 'enviarLecturasT']);


Route::post('/NumeroLecto', [ControllersMonitoreo::class, 'enviarLecturasPorCuenta']);
Route::post('/update_getdato', [ControllersMonitoreo::class, 'update_getdato']);


Route::post('/rutasxcuentaPromedioCuenta', [SoapController::class, 'rutasxcuentaPromedioCuenta']);

Route::get('/obtenerDatosT', [ControllersMonitoreo::class, 'obtenerDatosT']);

Route::get('facturamonitoreo', [ControllersMonitoreo::class, 'monitoreorutas']);



//Route::post('enviarLecturasSonde', [SoapController::class, 'enviarLecturasSonde'])->name('enviarLecturasSonde');
Route::post('enviarLecturas3', [SoapController::class, 'enviarLecturas3'])->name('enviarLecturas3');



Route::post('actualizarCalendario/{anio}/{mes}', [ControllersPlanificar::class, 'actualizarCalendario']);

Route::get('getGrecorrido', [ControllersPlanificar::class, 'getGrecorrido']);
Route::get('getGrecorrido/{numeroRuta}', [ControllersPlanificar::class, 'getGrecorridoP']);

Route::post('sincronizarApiHorizon', [SoapController::class, 'sincronizarApiHorizon'])->name('sincronizarApiHorizon');

Route::get('rutastotales', [SoapController::class, 'rutastotales']);
Route::get('rutastotalesR', [SoapController::class, 'rutastotalesR']);
Route::get('rutastotalesPromedio', [SoapController::class, 'rutastotalesPromedio']);
Route::get('rutastotalesEstimado', [SoapController::class, 'rutastotalesEstimado']);
Route::get('rutastotalesPromedio2', [SoapController::class, 'rutastotalesPromedio2']);


//
Route::get('rutastotalesEstim', [SoapController::class, 'rutastotalesEstim']);



Route::get('rutastotalesE', [SoapController::class, 'rutastotalesE']);


Route::post('sincronizarLecturasSola', [SoapController::class, 'enviarLecturasPorCuenta2']);

Route::post('ejecutarSP', [ControllersPlanificar::class, 'ejecutarSP']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
