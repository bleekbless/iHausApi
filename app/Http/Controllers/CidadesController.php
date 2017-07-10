<?php namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;

class CidadesController extends Controller {

    const MODEL = "App\Cidade";

    use RESTActions;


    public function findAll(){
        $m = $this::MODEL;

        return $m::with('estado')->get();
    }

    public function findAllByEstado( $id ){
        $m = $this::MODEL;

        return $m::with('estado')->where('estado_id', $id)->get();
    }

    public function index(){

        $cidades = Cidade::all();
        $estados = Estado::all();        

        return view('admin.cidade', ['cidades' => $cidades, 'estados' => $estados]);
    }

}
