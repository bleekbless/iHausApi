<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class VagasController extends Controller {

    const MODEL = "App\Vaga";
    const REPUBLICAS = "App\Republica";

    use RESTActions;



    public function cadastrarVaga(Request $request){

        $republicas = $this::REPUBLICAS;

        if(Auth::User()->republicas()->get()->count() <= 0){
           return $this->respond('500', ['status' => 'Nenhuma república cadastrada.']);
        }

       $reponse = $this->add($request);

       return $reponse;

    }

    public function candidatarVaga(Request $request, $id){

        $user = Auth::User();

        $user->vagas()->attach($id);

        return $this->respond('200', ['status' => 'Candidatado a vaga com sucesso.']);
        
    }
}
