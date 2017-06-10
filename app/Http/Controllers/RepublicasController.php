<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Imagem;


class RepublicasController extends Controller {

    const MODEL = "App\Republica";
    const IMG = "App\Imagem";
    const TEL = "App\Telefone";

    use RESTActions, ImagemsTrait;
    
    public function cadastrarRepublica(Request $request)
    {
        $model = $this::MODEL;
        $tel = $this::TEL;

        /*Pega os telefones 
        * Retorna um array vazio caso nao seja recebido nenhum valor.
        */
        $telefones = isset($request['telefones']) ? $request['telefones'] : array();
        $conveniencias = isset($request['conveniencias']) ? $request['conveniencias'] : array();


        $republica = $model::create($request->all());

        $res = $this->UploadImages($request, $republica);

        //Insere Telefones na Republica
        if(!empty($telefones)){
            foreach ($telefones as $key => $telefone) {
                $republica->telefones()
                ->save($tel::create([
                    'numeroTelefone' => $telefone['numeroTelefone'],
                    'idTipoTelefone' => $telefone['idTipoTelefone']
                    ]));
            }
        }
        //Insere Conveniencias na Republica
        if(!empty($conveniencias)){
            foreach ($conveniencias as $key => $conveniencia) {
                $republica->conveniencias()
                ->attach($conveniencia);
            }
        }

        return $this->respond('200', $res);
    }

}
