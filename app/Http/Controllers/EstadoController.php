<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;

class EstadoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $estados = Estado::all();

        return response()->json($estados->toJson());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $estado = Estado::find($id);

        if (!$estado instanceof Estado) {
            return "Mi pana, el estado con el id ${id} no existe";
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

        return response()->json($estado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $estado = Estado::find($id);

        if (!$estado instanceof Estado) {
            return "Mi pana, el estado con el id ${id} no existe";
        }

        $estado->delete();

        return response()->json('Estado eliminado correctamente');
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