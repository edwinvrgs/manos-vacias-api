<?php

namespace App\Http\Controllers;

class AdjuntoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $adjuntos = Adjunto::all();

        return response()->json($adjuntos->toJson());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $adjunto = Adjunto::find($id);

        if (!$adjunto instanceof Adjunto) {
            return "Mi pana, el adjunto con el id ${id} no existe";
        }

        return response()->json($adjunto->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$adjunto = Adjunto::create($request->all());

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
        $adjunto = Adjunto::find($id);

        if (!$adjunto instanceof Adjunto) {
            return "Mi pana, el adjunto con el id ${id} no existe";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $adjunto = Adjunto::find($id);

        if (!$adjunto instanceof Adjunto) {
            return "Mi pana, el adjunto con el id ${id} no existe";
        }

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