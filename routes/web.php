<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->group(['prefix' => 'api'], function() use ($app){

    $app->group(['prefix' => 'usuario'], function() use ($app){
        
        // /api/usuario

        //Retorna Todos Usuarios
        $app->get('', 'UsuariosController@all');

        //Retorna um usuario com id informado
        $app->get('{id}', 'UsuariosController@get');

        //Retorna os telefones do usuario
        $app->get('{id}/telefones', 'UsuariosController@getComTelefones');

        //Cria um usuario
        $app->post('', 'UsuariosController@add');

        //Altera usuario com id informado
        $app->put('{id}', 'UsuariosController@put');

        //Remove um usuario com id informado
        $app->delete('{id}', 'UsuariosController@remove');

    });

    $app->group(['prefix'=>'estado'], function() use ($app){
        // /api/estado

        /**
        * Rotas para estado
        */
        $app->get('', 'EstadosController@all');
        $app->get('{id}', 'EstadosController@get');
        $app->post('', 'EstadosController@add');
        $app->put('{id}', 'EstadosController@put');
        $app->delete('{id}', 'EstadosController@remove');
    });

    $app->group(['prefix'=>'cidade'], function() use ($app){
        // /api/cidade

        /**
        * Rotas para cidade
        */
        $app->get('', 'CidadesController@all');
        $app->get('{id}', 'CidadesController@get');
        $app->post('', 'CidadesController@add');
        $app->put('{id}', 'CidadesController@put');
        $app->delete('{id}', 'CidadesController@remove');
    });

    $app->group(['prefix'=>'bairro'], function() use ($app){
        // /api/bairro
        /**
        * Rotas para bairro
        */
        $app->get('', 'BairrosController@all');
        $app->get('{id}', 'BairrosController@get');
        $app->get('{id}/enderecos', 'BairrosController@getEnderecos');        
        $app->post('', 'BairrosController@add');
        $app->put('{id}', 'BairrosController@put');
        $app->delete('{id}', 'BairrosController@remove');
    });

    $app->group(['prefix'=>'endereco'], function() use ($app){
        /**
        * Routes for resource endereco
        */
        $app->get('', 'EnderecosController@all');
        $app->get('{id}', 'EnderecosController@get');
        $app->post('', 'EnderecosController@add');
        $app->put('{id}', 'EnderecosController@put');
        $app->delete('{id}', 'EnderecosController@remove');
    });

    $app->group(['prefix'=>'universidade'], function() use ($app){
        /**
        * Routes for resource universidade
        */
        $app->get('', 'UniversidadesController@all');
        $app->get('{id}', 'UniversidadesController@get');
        $app->post('', 'UniversidadesController@add');
        $app->put('{id}', 'UniversidadesController@put');
        $app->delete('{id}', 'UniversidadesController@remove');
    });
    

});

$app->get('/', function () use ($app) {
    return "Api-Documentation";
});


// /**
//  * Rotas para telefone
//  */
// $app->get('telefone', 'TelefonesController@all');
// $app->get('telefone/{id}', 'TelefonesController@get');
// $app->post('telefone', 'TelefonesController@add');
// $app->put('telefone/{id}', 'TelefonesController@put');
// $app->delete('telefone/{id}', 'TelefonesController@remove');










