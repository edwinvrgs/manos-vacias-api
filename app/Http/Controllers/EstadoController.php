<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;
use App\Bitacora;

class EstadoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $estados = Estado::where('enable', 1)->get();

        return response()->json($estados);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show(Request $request, $id) {
        $estado = Estado::find($id);

        if (!$estado instanceof Estado) {
            return "Mi pana, el estado con el id ${id} no existe";
        } else if($estado->estado == 0) {
            return "Mi pana, el estado con el id ${id} esta deshabilitado";
        }

        return response()->json($estado);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
        $estado = Estado::create($request->all());

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'estado';
        $bitacora->save();

    	return response()->json($estado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $estado = Estado::findOrFail($id);

        if (!$estado instanceof Estado) {
            return "Mi pana, el estado con el id ${id} no existe";
        }

        $estado->update($request->all());

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'estado';
        $bitacora->save();

        return response()->json($estado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $estado = Estado::find($id);

        if (!$estado instanceof Estado) {
            return "Mi pana, el estado con el id ${id} no existe";
        }

        $estado->enable = false;
        $estado->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'estado';
        $bitacora->save();

        return response()->json('Estado deshabilitado correctamente');
    }

    /**
     * Store Request Validation Rules
     *
     * @param Request $request
     * @return array
     */
    private function storeRequestValidationRules(Request $request) {
       return [
        ];
    }

    /**
     * Update Request validation Rules
     *
     * @param Request $request
     * @return array
     */
    private function updateRequestValidationRules(Request $request) {
        return [
        ];
    }
}