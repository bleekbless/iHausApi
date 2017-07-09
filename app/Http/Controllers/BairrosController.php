<?php namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Estado;

class BairrosController extends Controller {

    const MODEL = "App\Bairro";

    use RESTActions;

    public function findAll()
    {
        $m = $this::MODEL;

        return $m::with('cidade', 'cidade.estado')->get();
    }

    public function getEnderecos($id)
    {
        $m = $this::MODEL;

        return $m::with('enderecos')->find($id)->enderecos;
    }

}
