<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class VagasController extends Controller {

    const MODEL = "App\Vaga";
    const REPUBLICAS = "App\Republica";

    use RESTActions;



    public function cadastrarVaga(Request $request) {

        $republicas = $this::REPUBLICAS;

        if(Auth::User()->republicas()->get()->count() <= 0){
           return $this->respond('500', ['status' => 'Nenhuma república cadastrada.']);
        }

       $reponse = $this->add($request);

       return $reponse;

    }

    public function buscarVagas(Request $request) {

        $m = $this::MODEL;

        $tipoRepublica = $request->input('tipo');
        $universidades = $request->input('universidades');

        if (!empty($universidades)) {
            $universidades = explode(',', $universidades);
        }

        if ($tipoRepublica) {
            if ($tipoRepublica <= 0) {
                return $this->respond('500', ['error' => 'Busque um tipo existente.']);
            }
        }

        // University & Type
        if (!empty($universidades) && !empty($tipoRepublica)) {
            $resultado = $m::whereHas('republica', function($query) use ($universidades, $tipoRepublica) {
                $query->where('tipo_republica', '=', $tipoRepublica)
                ->whereIn('universidade_id', $universidades);
            })->get();
        }

        // Type
        elseif (!empty($tipoRepublica)) {
            $resultado = $m::whereHas('republica', function ($query) use ($tipoRepublica) {
                $query->where('tipo_republica', '=', $tipoRepublica);
            })->get();
        }

        // University
        elseif (!empty($universidades)) {
            $resultado = $m::whereHas('republica', function ($query) use ($universidades) {
                $query->whereIn('universidade_id', $universidades);
            })->get();
        } else {
            $resultado = '';
        }

        return $this->respond('200', $resultado);

    }
}