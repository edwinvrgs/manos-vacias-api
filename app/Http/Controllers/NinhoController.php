<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Representante;
use App\Ninho;
use App\Cancer;
use App\Requerimiento;

class NinhoController extends Controller {


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $ninhos = Ninho::all();

        return response()->json($ninhos);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function show($id) {
        $ninho = Ninho::find($id);

        if (!$ninho instanceof Ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        return response()->json($ninho);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request) {
        $representante = Representante::find($request->input('representante_cedula'));

        $cancer = Cancer::findMany($request->input('cancer_id'));

        $ninho = new Ninho($request->all());
        $ninho->representante()->associate($representante);
        $ninho->cancer()->saveMany($cancer);

        $ninho->save();

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
        $ninho = Ninho::findOrFail($id);

        if (!$ninho instanceof Ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        $ninho->update($request->all());

        return response()->json($ninho);
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

    public function indexCancer($id) {
        $ninho = Ninho::find($id);

        if (!$ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        $cancer = $ninho->cancer;

        if (!$cancer) {
            return "Mi pana, el ninho con el id ${id} no tiene cancer asociado";
        }

        return response()->json($cancer);
    }

    public function updateCancer(Request $request, $id, $id_cancer) {
        $ninho = Ninho::find($id);

        if (!$ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        foreach($ninho->cancer as $cancer) {
            if($cancer->id == $id_cancer) {
                $cancer->pivot->update($request->all());
                return response()->json($cancer);
            }
        }

        return "Mi pana, el ninho con el id ${id} no tiene ese tipo de cancer";
    }

    public function indexRequerimientos($id) {
        $ninho = Ninho::find($id);

        $requerimientos = Requerimiento::where('ninho_id', $id)->get();

        if (!$ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        if (!$requerimientos) {
            return "Mi pana, el ninho con el id ${id} no tiene requerimientos asociado";
        }

        return response()->json($requerimientos);
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