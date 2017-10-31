<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requerimiento;
use App\Ninho;
use App\Tipo;
use App\Bitacora;

class RequerimientoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $requerimientos = Requerimiento::where('enable', 1)->get();

        return response()->json($requerimientos);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show(Request $request, $id) {
        $requerimiento = Requerimiento::find($id);

        if (!$requerimiento instanceof Requerimiento) {
            return "Mi pana, el requerimiento con el id ${id} no existe";
        }

        return response()->json($requerimiento);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
        $tipo = Tipo::find($request->input('tipo_id'));
        $ninho = Ninho::find($request->input('ninho_id'));

        $requerimiento = new Requerimiento($request->all());
        $requerimiento->tipo()->associate($tipo);
        $requerimiento->ninho()->associate($ninho);

        $requerimiento->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'requerimiento';
        $bitacora->save();

        return response()->json($requerimiento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $requerimiento = Requerimiento::findOrFail($id);

        if (!$requerimiento instanceof Requerimiento) {
            return "Mi pana, el requerimiento con el id ${id} no existe";
        }

        $requerimiento->update($request->all());

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'requerimiento';
        $bitacora->save();

        return response()->json($requerimiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $requerimiento = Requerimiento::find($id);

        if (!$requerimiento instanceof Requerimiento) {
            return "Mi pana, el requerimiento con el id ${id} no existe";
        }

        $requerimiento->enable = 0;
        $requerimiento->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'requerimiento';
        $bitacora->save();

        return response()->json('Requerimiento deshabilitado correctamente');
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