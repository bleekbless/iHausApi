<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Universidade;
use App\TipoTelefone;
use App\Estado;
use App\Cidade;
use App\Bairro;
use App\Endereco;
use App\Telefone;

class UniversidadesController extends Controller
{

    const MODEL = "App\Universidade";

    use RESTActions, EnderecoTrait;

    public function index()
    {

        $universidades = Universidade::all();
        $tipos = TipoTelefone::all();

        return view('admin.universidade', ['universidades' => $universidades, 'tipos' => $tipos]);
    }

    public function cadastrarUniversidade(Request $request)
    {
        
        //pegar o endereco
        $endereco = json_decode($request['endereco']);

        //checa se o estado ja existe no banco
        $estado = $this->checaEstado($endereco->estado);

        //checa se a cidade ja existe no banco
        $cidade = $this->checaCidade($endereco->cidade, $estado);

        //checa se o bairro ja existe no banco
        $bairro = $this->checaBairro($endereco->estado, $cidade);

        /*$endereco['estado_id'] = $estado->id;
        $endereco['cidade_id'] = $cidade->id;*/
        $endereco->bairro_id = $bairro->id;

        //cria o novo endereco
        $endereco = Endereco::create(get_object_vars($endereco));

        //Inclui o id do Endereço criado a request feita
        $request['endereco_id'] = $endereco->id;

        $universidade = Universidade::create($request->all());

        //Cria o Contato
        if(isset($request['numTelefone'])){

            $universidade->telefones()->create([
                'numeroTelefone' => $request['numTelefone'],
                'tipoTelefone_id' => $request['id_tipo']
            ]);
            
        }

        return $this->respond(200, 'Sucesso.');
    }


}
