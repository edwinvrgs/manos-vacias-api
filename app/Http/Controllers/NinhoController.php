<?php

namespace App\Http\Controllers;

class NinhoController extends Controller {


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $ninhos = Ninho::all();

        return response()->json($ninhos->toJson());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $ninhos = Ninho::find($id);

        if (!$ninho instanceof Ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        return response()->json($ninhos->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$ninho = Ninho::create($request->all());

    	return response()->json($ninho);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $ninho = Ninho::find($id);

        if (!$ninho instanceof Ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $ninho = Ninho::find($id);

        if (!$ninho instanceof Ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        $ninho->delete();

        return response()->json('Ninho eliminado correctamente');
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