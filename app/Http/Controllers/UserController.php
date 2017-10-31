<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\Representante;
use App\Bitacora;

class UserController extends Controller {

    public function login(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)
                ->where('password', $password)->get();

        if (!$user) {
            return "Mi pana, el user que intentas buscar no existe";
        }

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'iniciar sesion';
        $bitacora->tabla = 'user';
        $bitacora->save();

    	return response()->json($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show(Request $request, $id) {
        $user = User::find($id);

        if (!$user instanceof User) {
            return "Mi pana, el user con el id ${id} no existe";
        }

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
        $rol = Rol::find($request->input('rol_id'));
        $representante = Representante::find($request->input('representante_cedula'));

        $user = new User($request->all());
        $user->password = $request->input('password');
        $user->rol()->associate($rol);
        $user->representante()->associate($representante);
        $user->save();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'user';
        $bitacora->save();

    	return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        if (!$user instanceof User) {
            return "Mi pana, el user con el id ${id} no existe";
        }

        $user->update($request->all());

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'user';
        $bitacora->save();

    	return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $user = User::find($id);

        if (!$user instanceof User) {
            return "Mi pana, el user con el id ${id} no existe";
        }

        $user->delete();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'user';
        $bitacora->save();

        return response()->json('User eliminado correctamente');
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