<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Imagem;


class RepublicasController extends Controller
{

    const MODEL = "App\Republica";
    const IMG = "App\Imagem";
    const TEL = "App\Telefone";

    use RESTActions, ImagemsTrait;

    public function cadastrarRepublica(Request $request)
    {
        $model = $this::MODEL;
        $tel = $this::TEL;

        $this->validate($request, $model::$rules);

        $republica = $model::create($request->all());

        /*
         * Pega os telefones e as Conveniencias
         * Retorna um array vazio caso nao seja recebido nenhum valor.
         */

        $telefones = isset($request['telefones']) ? $request['telefones'] : array();

        //Insere Telefones na Republica
        if (!empty($telefones)) {
            foreach ($telefones as $key => $telefone) {
                $republica->telefones()
                    ->save($tel::create([
                    'numeroTelefone' => $telefone['numeroTelefone'],
                    'idTipoTelefone' => $telefone['idTipoTelefone']
                ]));
            }
        }

        $conveniencias = isset($request['conveniencias']) ? $request['conveniencias'] : array();
        
        //Insere Conveniencias na Republica
        if (!empty($conveniencias)) {
            foreach ($conveniencias as $key => $conveniencia) {
                $republica->conveniencias()
                    ->attach($conveniencia);
            }
        }

        if ($request->hasFile('imagens')) {
            $res = $this->UploadImages($request, $republica);
        }


        return $this->respond('200', 'República salva com sucesso.');
    }

    public function buscarRepublica(Request $request)
    {

        $m = $this::MODEL;

        $tipo = $request->input('tipo');
        $universidades = $request->input('universidades');
        $filter = $request->input('filter');

        if (!empty($universidades)) {
            $universidades = explode(',', $universidades);
        }

        if (!empty($filter)) {
            $filter = explode(',', $filter);
        }

        if ($tipo) {
            if ($tipo <= 0) {
                return $this->respond('500', ['error' => 'Busque um tipo existente.']);
            }
        }

        // University & Type & Filter
        if (!empty($universidades) && !empty($tipo) && !empty($filter)) {
            $resultado = $m::whereHas('conveniencias', function ($q) use ($filter) {
                $q->whereIn('conveniencia_id', $filter);
            })
                ->where('tipo_republica', '=', $tipo)
                ->whereIn('universidade_id', $universidades)
                ->get();
        }
        
        // University & Type
        if (!empty($universidades) && !empty($tipo) && empty($filter)) {
            $resultado = $m::where('tipo_republica', '=', $tipo)->whereIn('universidade_id', $universidades)->get();
        }

        // Type
        if (empty($universidades) && !empty($tipo) && empty($filter)) {
            $resultado = $m::where('tipo_republica', '=', $tipo)->get();
        }

        // Type & Filter
        if (empty($universidades) && !empty($filter) && !empty($tipo)) {
            $resultado = $m::whereHas('conveniencias', function ($q) use ($filter) {
                $q->whereIn('conveniencia_id', $filter);
            })->where('tipo_republica', '=', $tipo)->get();
        }

        // University
        if (empty($filter) && empty($tipo) && !empty($universidades)) {
            $resultado = $m::whereIn('universidade_id', $universidades)->get();
        }

        // University & Filter
        if (!empty($filter) && empty($tipo) && !empty($universidades)) {
            $resultado = $m::whereHas('conveniencias', function ($q) use ($filter) {
                $q->whereIn('conveniencia_id', $filter);
            })->whereIn('universidade_id', $universidades)->get();
        }

        // Filter
        if (!empty($filter) && empty($universidades) && empty($tipo)) {
            $resultado = $m::whereHas('conveniencias', function ($q) use ($filter) {
                $q->whereIn('conveniencia_id', $filter);
            })->get();
        }

        if (!count($resultado)) {
            return $this->respond('204', '');
        }

        return $this->respond('200', $resultado);

    }

}
