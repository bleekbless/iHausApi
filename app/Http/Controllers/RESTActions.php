<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

trait RESTActions {


    public function all()
    {
        $m = self::MODEL;

        return $this->respond(Response::HTTP_OK, $m::all());
    }

    public function get($id)
    {
        //Verifica se o usuario autenticado é o mesmo que está 
        //tentando acessar os dados comparando o ID do token com o id da requisição
        if(!Auth::check())
            return $this->respond(Response::HTTP_UNAUTHORIZED, "Unauthorized");

        $m = self::MODEL;

        $model = $m::find($id);

        //Não encontrou o usuario
        if(is_null($model)){
            return $this->respond(Response::HTTP_NOT_FOUND);
        }

        //Retorna o usuário
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function add(Request $request)
    {
        if(!Auth::check())
            return $this->respond(Response::HTTP_UNAUTHORIZED, "Unauthorized");
        
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        return $this->respond(Response::HTTP_CREATED, $m::create($request->all()));
    }

    public function put(Request $request, $id)
    {

        if(!Auth::check())
            return $this->respond(Response::HTTP_UNAUTHORIZED, "Unauthorized");

        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        $model = $m::find($id);
        if(is_null($model)){
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        $model->update($request->all());
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function remove($id)
    {
        //Verificação
        if(!Auth::check())
            return $this->respond(Response::HTTP_UNAUTHORIZED, "Unauthorized");

        //Exclusão
        $m = self::MODEL;
        if(is_null($m::find($id))){
            return $this->respond(Response::HTTP_NOT_FOUND);
        }

        $m::destroy($id);
        return $this->respond(Response::HTTP_OK, 'Removido com sucesso.');
    }

    protected function respond($status, $data = [])
    {
        return response()->json($data, $status);
    }

}
