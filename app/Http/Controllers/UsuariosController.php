<?php namespace App\Http\Controllers;

class UsuariosController extends Controller {

    const MODEL = "App\Usuario";

    use RESTActions;

    public function getComTelefones($id){
        $m = $this::MODEL;

        return $m::with('telefones')->find($id)->telefones;

    }

}
