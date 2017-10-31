<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adjunto;
use App\Requerimiento;
use App\Bitacora;

class AdjuntoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $adjuntos = Adjunto::all();

        return response()->json($adjuntos);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show(Request $request, $id) {
        $adjunto = Adjunto::find($id);

        if (!$adjunto instanceof Adjunto) {
            return "Mi pana, el adjunto con el id ${id} no existe";
        }

        return response()->json($adjunto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {

        $requerimiento = Requerimiento::find($request->input('requerimiento_id'));

        $adjunto = new Adjunto($request->all());
        $adjunto->requerimiento()->associate($requerimiento);
        $adjunto->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'adjunto';
        $bitacora->save();

        return response()->json($adjunto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $adjunto = Adjunto::findOrFail($id);

        if (!$adjunto instanceof Adjunto) {
            return "Mi pana, el adjunto con el id ${id} no existe";
        }

        $adjunto->update($request->all());

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'adjunto';
        $bitacora->save();

        return response()->json($adjunto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $adjunto = Adjunto::find($id);

        if (!$adjunto instanceof Adjunto) {
            return "Mi pana, el adjunto con el id ${id} no existe";
        }

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'adjunto';
        $bitacora->save();

        $adjunto->delete();

        return response()->json('Adjunto eliminado correctamente');
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