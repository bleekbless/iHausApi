<?php namespace App\Http\Controllers;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

use Illuminate\Hashing\BcryptHasher;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Illuminate\Support\Facades\Session;

class UsuariosController extends Controller
{

    const MODEL = "App\Usuario";
    const TEL = "App\Telefone";

    use RESTActions;



    public function __construct()
    {

    }

    public function getComTelefones($id)
    {
        $m = $this::MODEL;

        return $m::with('telefones')->find($id)->telefones;
    }

    public function cadastrar(Request $request)
    {
        $m = $this::MODEL;
        $t = $this::TEL;

        $this->validate($request, $m::$rules);

        $telefones = $request['telefones'];

        $request['password'] = app('hash')->make($request['password']);

        $user = $m::create($request->all());

        //Salva os telefones do usuario 1 ou muitos
        if (isset($telefones)) {
            foreach ($telefones as $key => $telefone) {
                $user->telefones()
                    ->save($t::create([
                    'numeroTelefone' => $telefone['numeroTelefone'],
                    'idTipoTelefone' => $telefone['idTipoTelefone']
                ]));
            }
        }

        $token = $this->generateToken($user);

        return $this->respond('200', ['usuario' => $user, 'token' => $token->__toString()]);
    }

    public function login(Request $request)
    {


        $m = $this::MODEL;

        $signer = new Sha256();

        if (!$request['email'] || !$request['password']) {
            return $this->respond('500', ['error' => 'Email e/ou senha não informados.']);
        }

        $user = $m::where('email', $request['email'])
            ->first();

        if (!$user) {
            return $this->respond('500', ['error' => 'Usuário não encontrado.']);
        }

        if (!app('hash')->check($request['password'], $user->password)) {
            return $this->respond('500', ['error' => 'Senha incorreta.']);
        }

        $token = $this->generateToken($user);

        // if($user->id == 1){
        //     $_SESSION['token'] = $token->getToken();
        //     return view('dashboard');
        // }

        return $this->respond('200', ['usuario' => $user, 'token' => $token->__toString()]);

    }

    public function logout()
    {
        if (session_id() != '')
            session_destroy();
        return redirect('/admin/login');
    }

    public function updateUsuarioComSenha(Request $request, $id)
    {

        $m = $this::MODEL;

        $this->validade($request, $m::$rules);

        //Hash da senha
        $request['password'] = app('hash')->make($request['password']);

        $user = $m::find($id);

        if (is_null($model)) {
            return $this->respond('500', ['status' => 'Usuário não encontrado.']);
        }

        $user->update($request->all());

        return $this->respond('200', ['status' => 'Alterado com sucesso.']);
    }

    public function applyToVacant(Request $request, $id)
    {
        $user = Auth::User();

        $user->vagas()->attach($id);

        return $this->respond('201', ['status' => 'Candidatado a vaga com sucesso.']);

    }

    public function unapplyToVacant(Request $request, $id)
    {
        $user = Auth::User();

        $user->vagas()->detach($id);

        return $this->respond('200', ['status' => 'Removido com sucesso.']);
    }

    private function generateToken($user)
    {

        $signer = new Sha256();

        return (new Builder())->setIssuer(env('APP_ISSUER')) // Configures the issuer (iss claim)
            ->setAudience(env('APP_ISSUER')) // Configures the audience (aud claim)
            ->setId(env('APP_KEY'), true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            ->set('uid', $user->id) // Configures a new claim, called "uid"
            ->set('email', $user->email) // Configures a new claim, called "uid"            
            ->sign($signer, env('TOKEN_PASSWORD'))
            ->getToken();
    }


}
