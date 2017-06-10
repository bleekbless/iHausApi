<?php namespace App\Http\Controllers;

use App\Estado;

class EstadosController extends Controller {

    const MODEL = "App\Estado";

    use RESTActions;

    public function __construct()
    {
    }

    public function index(){

        $estados = Estado::all();

        return view('admin.estado', ['estados' => $estados]);
    }

}
