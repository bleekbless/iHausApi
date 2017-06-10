<?php namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;

class CidadesController extends Controller {

    const MODEL = "App\Cidade";

    use RESTActions;


    public function index(){

        $cidades = Cidade::all();
        $estados = Estado::all();        

        return view('admin.cidade', ['cidades' => $cidades, 'estados' => $estados]);
    }

}
