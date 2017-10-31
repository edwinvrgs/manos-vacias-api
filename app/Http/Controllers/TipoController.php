<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;
use App\Bitacora;

class TipoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $tipos = Tipo::where('enable', 1)->get();

        return response()->json($tipos);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show(Request $request, $id) {
        $tipo = Tipo::find($id);

        if (!$tipo instanceof Tipo) {
            return "Mi pana, el tipo con el id ${id} no existe";
        } else if($tipo->estado == 0) {
            return "Mi pana, el tipo con el id ${id} esta deshabilitado";
        }

        return response()->json($tipo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$tipo = Tipo::create($request->all());

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'tipo';
        $bitacora->save();

    	return response()->json($tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $tipo = Tipo::findOrFail($id);

        if (!$tipo instanceof Tipo) {
            return "Mi pana, el tipo con el id ${id} no existe";
        }

        $tipo->update($request->all());

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'tipo';
        $bitacora->save();

    	return response()->json($tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $tipo = Tipo::find($id);

        if (!$tipo instanceof Tipo) {
            return "Mi pana, el tipo con el id ${id} no existe";
        }

        $tipo->enable = false;
        $tipo->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'tipo';
        $bitacora->save();

        return response()->json('Tipo deshabilitado correctamente');
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