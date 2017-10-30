<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;

class UserController extends Controller {

    public function login(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)
                ->where('password', app('hash')->make($password))->get();

        if (!$user) {
            return "Mi pana, el user que intentas buscar no existe";
        }

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
    public function show($id) {
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

        $user = new User($request->all());
        $user->password = $request->input('password');
        $user->rol()->associate($rol);
        $user->save();

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

    	return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id) {
        $user = User::find($id);

        if (!$user instanceof User) {
            return "Mi pana, el user con el id ${id} no existe";
        }

        $user->delete();

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