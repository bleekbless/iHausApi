<?php namespace App\Http\Controllers;

use App\Universidade;

class UniversidadesController extends Controller {

    const MODEL = "App\Universidade";

    use RESTActions;

    public function index(){

        $universidades = Universidade::all();

        return view('admin.universidade', ['universidades' => $universidades]);

    }

}
