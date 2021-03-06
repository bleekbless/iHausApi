<?php

namespace App\Providers;

use App\Usuario;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Illuminate\Support\Facades\Session;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            

            if( $request->header('api-token') != null ){
                $token = $request->header('api-token');

                if($token){
                    
                    $token = (new Parser())->parse((string) $token);

                    $signer = new Sha256();
                    
                    if($token->verify($signer, env('TOKEN_PASSWORD'))){
                        $user = Usuario::where('id', $token->getClaim('uid'))->first();
                        $email = $token->getClaim('email');

                        if ($email === $user->email) {
                            return $user;
                        } else {
                            return null;                            
                        }
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }else{
                return null;
            }
        });
    }
}
