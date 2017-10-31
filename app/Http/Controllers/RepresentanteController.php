<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Representante;
use App\Municipio;
use App\User;
use App\Bitacora;

class RepresentanteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $representantes = Representante::join('municipio', 'representante.municipio_id', '=', 'municipio.id')->select('*', 'municipio.descripcion as descripcion_municipio')->where('enable', 1)->get();

        return response()->json($representantes);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show(Request $request, $id) {
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

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'representante';
        $bitacora->save();

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

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'representante';
        $bitacora->save();

        return response()->json($representante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $representante = Representante::find($id);

        if (!$representante instanceof Representante) {
            return "Mi pana, el representante con el id ${id} no existe";
        }

        $representante->enable = 0;
        $representante->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'representante';
        $bitacora->save();

        return response()->json('Representante deshabilitado correctamente');
    }

    public function indexNinhos(Request $request, $id) {
        $representates = Representante::find($id);

        $ninhos = $representates->ninhos;

        if (!$ninhos) {
            return "Mi pana, el representates con el id ${id} no tiene ninhos asociados";
        }

        return response()->json($ninhos);
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