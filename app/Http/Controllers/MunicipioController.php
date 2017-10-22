<?php

namespace App\Http\Controllers;

class MunicipioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $municipios = Municipio::all();

        return response()->json($municipios->toJson());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $municipio = Municipio::find($id);

        if (!$municipio instanceof Municipio) {
            return "Mi pana, el municipio con el id ${id} no existe";
        }

        return response()->json($municipio->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$municipio = Municipio::create($request->all());

    	return response()->json($municipio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $municipio = Municipio::find($id);

        if (!$municipio instanceof Municipio) {
            return "Mi pana, el municipio con el id ${id} no existe";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $municipio = Municipio::find($id);

        if (!$municipio instanceof Municipio) {
            return "Mi pana, el municipio con el id ${id} no existe";
        }

        $municipio->delete();

        return response()->json('Municipio eliminado correctamente');
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