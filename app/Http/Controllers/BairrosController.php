<?php namespace App\Http\Controllers;

class BairrosController extends Controller {

    const MODEL = "App\Bairro";

    use RESTActions;

    public function getEnderecos($id)
    {
        $m = $this::MODEL;

        return $m::with('enderecos')->find($id)->enderecos;
    }

}
