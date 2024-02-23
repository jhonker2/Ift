<?php

namespace App\Http\Controllers;

use App\Models\TabFuente;
use App\Models\TabTipoTramite;
use App\Models\TabTramite;
use App\Models\TabProceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CrearProcesoController extends Controller
{



    public function create()
    {
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();
        $fuentes = TabFuente::where('estado', 'ACTIVO')->pluck('descripcion', 'idfuente');
        $tiposTramite = TabTipoTramite::where('estado', 'ACTIVO')->pluck('descripcion', 'idtipocompromiso');

        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];
        return view('Sigop.Tramite.CrearTramite', compact('fuentes', 'tiposTramite', 'procesos', 'usuarioSesion'));
    }

    public function store2(Request $request)
    {
        try {
            $data = $request->only(['idfuente', 'idtipocompromiso', 'solicitante']);
            $data['idproceso'] = 1; // Valor por defecto
            $data['uregistro'] = session('SESSION_CEDULA');
            $data['estado'] = 'ACTIVO'; // Valor por defecto
            TabTramite::create($data);

            session()->flash('success', 'Trámite creado con éxito.');
        } catch (\Exception $e) {
            // Enviar mensaje de error
            session()->flash('error', 'Error, comuníquese con informática.');
        }

        return redirect()->route('creartramite');
    }

    public function store(Request $request)
    {
        try {
            // Preparar los datos para el procedimiento almacenado
            $idfuente = $request->input('idfuente');
            $idtipocompromiso = $request->input('idtipocompromiso');
            $solicitante = $request->input('solicitante');
            $idproceso = session('sesion_idproceso');
            $uregistro = session('SESSION_CEDULA');
            $uresponsable = $request->input('responsableId');
            $descripcion_tarea = $request->input('descripcionT');

            // Llamar al procedimiento almacenado
            DB::select(
                'CALL InsertarDatosP(?,?,?,?,?,?,?)',
                [$idfuente, $idproceso, $idtipocompromiso, $uregistro, $solicitante, $uresponsable, $descripcion_tarea]
            );

            session()->flash('success', 'Trámite creado con éxito.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error, comuníquese con informática.');
        }

        return redirect()->route('/creartramite');
    }
}
