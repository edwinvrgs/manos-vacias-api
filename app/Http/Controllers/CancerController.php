<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancer;

class CancerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $cancers = Cancer::where('estado', 1)->get();

        return response()->json($cancers);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $cancer = Cancer::find($id);

        if (!$cancer instanceof Cancer) {
            return "Mi pana, el cancer con el id ${id} no existe";
        } else if($cancer->estado == 0) {
            return "Mi pana, el cancer con el id ${id} esta deshabilitado";
        }

        return response()->json($cancer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$cancer = Cancer::create($request->all());

    	return response()->json($cancer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $cancer = Cancer::findOrFail($id);

        if (!$cancer instanceof Cancer) {
            return "Mi pana, el cancer con el id ${id} no existe";
        }

        $cancer->update($request->all());

        return response()->json($cancer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $cancer = Cancer::find($id);

        if (!$cancer instanceof Cancer) {
            return "Mi pana, el cancer con el id ${id} no existe";
        }

        $cancer->estado = false;
        $cancer->save();

        return response()->json('Cancer deshabilitado correctamente');
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