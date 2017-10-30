<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $roles = Rol::where('estado', 1)->get();

        return response()->json($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $rol = Rol::find($id);

        if (!$rol instanceof Rol) {
            return "Mi pana, el rol con el id ${id} no existe";
        } else if($rol->estado == 0) {
            return "Mi pana, el rol con el id ${id} esta deshabilitado";
        }

        return response()->json($rol);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
    	$rol = Rol::create($request->all());

    	return response()->json($rol);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $rol = Rol::findOrFail($id);

        if (!$rol instanceof Rol) {
            return "Mi pana, el rol con el id ${id} no existe";
        }

        $rol->update($request->all());

        return response()->json($rol);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $rol = Rol::find($id);

        if (!$rol instanceof Rol) {
            return "Mi pana, el rol con el id ${id} no existe";
        }

        $rol->estado = false;
        $rol->save();

        return response()->json('Rol deshabilitado correctamente');
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