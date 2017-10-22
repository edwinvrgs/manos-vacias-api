<?php

namespace App\Http\Controllers;

class RequerimientoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $requerimientos = Requerimiento::all();

        return response()->json($requerimientos->toJson());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $requerimiento = Requerimiento::find($id);

        if (!$requerimiento instanceof Requerimiento) {
            return "Mi pana, el requerimiento con el id ${id} no existe";
        }

        return response()->json($requerimiento->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$requerimiento = Requerimiento::create($request->all());

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
        $requerimiento = Requerimiento::find($id);

        if (!$requerimiento instanceof Requerimiento) {
            return "Mi pana, el requerimiento con el id ${id} no existe";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $requerimiento = Requerimiento::find($id);

        if (!$requerimiento instanceof Requerimiento) {
            return "Mi pana, el requerimiento con el id ${id} no existe";
        }

        $requerimiento->delete();

        return response()->json('Requerimiento eliminado correctamente');
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