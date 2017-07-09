<?php namespace App\Http\Controllers;

use App\Conveniencia;

class ConvenienciasController extends Controller {

    const MODEL = "App\Conveniencia";

    use RESTActions;

    public function index(){

        $conveniencias = Conveniencia::all();

        return view('admin.conveniencia', ['conveniencias'=>$conveniencias]);
    }

    public function getConveninenciasByRepublica ($id) {
        $m = $this::MODEL;
        
        return $m::where('')

    }

}
