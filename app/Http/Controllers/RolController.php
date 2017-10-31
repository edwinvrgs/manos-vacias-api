<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\Bitacora;

class RolController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $roles = Rol::where('enable', 1)->get();

        return response()->json($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show(Request $request, $id) {
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

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'rol';
        $bitacora->save();

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

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'rol';
        $bitacora->save();

        return response()->json($rol);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $rol = Rol::find($id);

        if (!$rol instanceof Rol) {
            return "Mi pana, el rol con el id ${id} no existe";
        }

        $rol->enable = false;
        $rol->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'rol';
        $bitacora->save();

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