<?php namespace App\Http\Controllers;

use App\TipoTelefone;

class TipoTelefonesController extends Controller {

    const MODEL = "App\TipoTelefone";

    use RESTActions;


    public function index(){
        $tipostel = TipoTelefone::all();

        return view('admin.tipotel',['tipostel', $tipostel]);
    }

}
