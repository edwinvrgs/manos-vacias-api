<?php

namespace App\Http\Controllers;

class RepresentanteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $representates = Representante::all();

        return response()->json($representates->toJson());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $representante = Representante::find($id);

        if (!$representante instanceof Representante) {
            return "Mi pana, el representante con el id ${id} no existe";
        }

        return response()->json($representante->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$representante = Representante::create($request->all());

    	return response()->json($representante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $representante = Representante::find($id);

        if (!$representante instanceof Representante) {
            return "Mi pana, el representante con el id ${id} no existe";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $representante = Representante::find($id);

        if (!$representante instanceof Representante) {
            return "Mi pana, el representante con el id ${id} no existe";
        }

        $representante->delete();

        return response()->json('Representante eliminado correctamente');
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