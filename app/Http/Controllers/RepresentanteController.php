<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Representante;
use App\Municipio;
use App\User;

class RepresentanteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $representates = Representante::all();

        return response()->json($representates);
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

        return response()->json($representante);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
        $municipio = Municipio::find($request->input('municipio_id'));
        $oldRepresentante = Representante::find($request->input('cedula'));

        if($oldRepresentante) {
            return 'Mi pana, esa cedula ya existe. No me vengas a hacer trampa';
        }

        $representante = new Representante($request->all());
        $representante->municipio()->associate($municipio);

        $representante->save();

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

        $representante->update($request->all());

        return response()->json($representante);
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