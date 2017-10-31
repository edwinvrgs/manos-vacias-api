<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Representante;
use App\Ninho;
use App\Cancer;
use App\Requerimiento;
use App\Bitacora;

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
    public function show(Request $request, $id) {
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

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'crear';
        $bitacora->tabla = 'ninho';
        $bitacora->save();

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

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'actualizar';
        $bitacora->tabla = 'ninho';
        $bitacora->save();

        return response()->json($ninho);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id) {
        $ninho = Ninho::find($id);

        if (!$ninho instanceof Ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        $ninho->delete();

        $bitacora = new Bitacora();
        $bitacora->ip = $request->getClientIp();
        $bitacora->operacion = 'eliminar';
        $bitacora->tabla = 'ninho';
        $bitacora->save();

        return response()->json('Ninho eliminado correctamente');
    }

    public function indexCancer(Request $request, $id) {
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

    public function storeCancer(Request $request, $id) {
        $ninho = Ninho::find($id);

        $cancer_id = $request->input('cancer_id');
        $cancer = Cancer::find($cancer_id);

        if (!$ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        if (!$cancer) {
            return "Mi pana, el cancer con el id ${cancer_id} no existe";
        }

        if (!$ninho->cancer->contains($cancer->id)) {
            $ninho->cancer()->save($cancer);

            $bitacora = new Bitacora();
            $bitacora->ip = $request->getClientIp();
            $bitacora->operacion = 'crear';
            $bitacora->tabla = 'ninho_cancer';
            $bitacora->save();
        } else {
            return "Mi pana, el cancer con el id ${cancer_id} ya esta asignado a este ninho";
        }

        return response()->json($ninho);
    }

    public function updateCancer(Request $request, $id, $id_cancer) {
        $ninho = Ninho::find($id);

        if (!$ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        foreach($ninho->cancer as $cancer) {
            if($cancer->id == $id_cancer) {
                $cancer->pivot->update($request->all());

                $bitacora = new Bitacora();
                $bitacora->ip = $request->getClientIp();
                $bitacora->operacion = 'actualizar';
                $bitacora->tabla = 'ninho_cancer';
                $bitacora->save();

                return response()->json($cancer);
            }
        }

        return "Mi pana, el ninho con el id ${id} no tiene ese tipo de cancer";
    }

    public function destroyCancer(Request $request, $id, $id_cancer) {
        $ninho = Ninho::find($id);

        if (!$ninho) {
            return "Mi pana, el ninho con el id ${id} no existe";
        }

        foreach($ninho->cancer as $cancer) {
            if($cancer->id == $id_cancer) {
                $cancer->pivot->enable = false;
                $cancer->pivot->save();

                $bitacora = new Bitacora();
                $bitacora->ip = $request->getClientIp();
                $bitacora->operacion = 'eliminar';
                $bitacora->tabla = 'ninho_cancer';
                $bitacora->save();

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