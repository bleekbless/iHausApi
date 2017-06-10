<?php namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Estado;

class BairrosController extends Controller {

    const MODEL = "App\Bairro";

    use RESTActions;

    public function index(){

        $bairros = Bairro::all();
        $cidades = Cidade::all();
        $estados = Estado::all();

        return view('admin.bairro', [
            'bairros' => $bairros, 
            'cidades' => $cidades, 
            'estados' => $estados
            ]);
    }

    public function getEnderecos($id)
    {
        $m = $this::MODEL;

        return $m::with('enderecos')->find($id)->enderecos;
    }

}
