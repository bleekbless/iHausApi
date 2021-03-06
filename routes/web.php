<?php

/*
|ROTAS
*/

$app->group(['prefix' => 'api'], function () use ($app) {

    $app->group(['prefix' => 'visita'], function () use ($app) {
        $app->get('', 'VisitasController@all');
        $app->get('{id}', 'VisitasController@get');
        $app->post('', 'VisitasController@add');
        $app->post('verify', 'VisitasConstroller@checkNextVisits');
        $app->put('{id}', 'VisitasController@put');
        $app->delete('{id}', 'VisitasController@remove');
    });

    $app->group(['prefix' => 'usuario'], function () use ($app) {
        //Cria um usuario
        $app->post('', 'UsuariosController@cadastrar');

        //Loga um Usuario
        $app->post('login', 'UsuariosController@login');

        //Desloga o usuario
        $app->get('logout', 'UsuariosController@logout');

        $app->group(['prefix' => 'password'], function () use ($app) {

            $app->post('/email', 'PasswordController@postEmail');
            $app->post('/reset/{token}', 'PasswordController@postReset');
        });
    });

    $app->group(['prefix' => 'usuario', 'middleware'=> 'auth'], function () use ($app) {
        //Altera usuario com id informado
        $app->put('{id}', 'UsuariosController@put');

        //Altera usuario e senha com id informado
        $app->put('{id}', 'UsuariosController@updateUsuarioComSenha');

        //Remove um usuario com id informado
        $app->delete('{id}', 'UsuariosController@remove');

         //Retorna Todos Usuarios
        $app->get('', 'UsuariosController@all');

        //Retorna um usuario com id informado
        $app->get('{id}', 'UsuariosController@get');

        //Retorna os telefones do usuario
        $app->get('{id}/telefones', 'UsuariosController@getComTelefones');

        // Candidata usuario a vaga
        $app->post('vaga/{id}', 'UsuariosController@applyToVacant');
        
        // Descandidata usuario a vaga
        $app->delete('vaga/{id}', 'UsuariosController@unapplyToVacant');
    });

    $app->group(['prefix'=>'estado'], function () use ($app) {

        $app->get('', 'EstadosController@all');
        $app->get('{id}', 'EstadosController@get');
    });

    $app->group(['prefix'=>'estado', 'middleware'=> 'auth'], function () use ($app) {
        $app->post('', 'EstadosController@add');
        $app->put('{id}', 'EstadosController@put');
        $app->delete('{id}', 'EstadosController@remove');
    });

    $app->group(['prefix'=>'cidade'], function () use ($app) {
        // /api/cidade
        $app->get('', 'CidadesController@all');
        $app->get('{id}', 'CidadesController@get');
    });

    $app->group(['prefix'=>'cidade', 'middleware'=> 'auth'], function () use ($app) {
        $app->post('', 'CidadesController@add');
        $app->put('{id}', 'CidadesController@put');
        $app->delete('{id}', 'CidadesController@remove');
    });

    $app->group(['prefix'=>'bairro'], function () use ($app) {
        // /api/bairro
        $app->get('', 'BairrosController@findAll');
        $app->get('{id}', 'BairrosController@get');
    });

    $app->group(['prefix'=>'bairro', 'middleware'=> 'auth'], function () use ($app) {
        $app->get('{id}/enderecos', 'BairrosController@getEnderecos');
        $app->post('', 'BairrosController@add');
        $app->put('{id}', 'BairrosController@put');
        $app->delete('{id}', 'BairrosController@remove');
    });

    $app->group(['prefix'=>'complemento'], function () use ($app) {
        $app->get('', 'ComplementosController@all');
        $app->get('{id}', 'ComplementosController@get');
    });
    
    $app->group(['prefix'=>'complemento', 'middleware' => ['auth', 'admin']], function () use ($app) {
        $app->post('', 'ComplementosController@add');
        $app->put('{id}', 'ComplementosController@put');
        $app->delete('{id}', 'ComplementosController@remove');
    });

    $app->group(['prefix'=>'endereco'], function () use ($app) {
        $app->get('', 'EnderecosController@all');
        $app->get('{id}', 'EnderecosController@get');
    });

    $app->group(['prefix'=>'endereco', 'middleware'=> 'auth'], function () use ($app) {
        $app->post('', 'EnderecosController@add');
        $app->put('{id}', 'EnderecosController@put');
        $app->delete('{id}', 'EnderecosController@remove');
    });

    $app->group(['prefix'=>'universidade'], function () use ($app) {
        $app->get('', 'UniversidadesController@findAll');
        $app->get('{id}', 'UniversidadesController@get');
    });

    $app->group(['prefix'=>'universidade', 'middleware'=> ['auth', 'admin']], function () use ($app) {
        $app->post('', 'UniversidadesController@cadastrarUniversidade');
        $app->put('{id}', 'UniversidadesController@put');
        $app->delete('{id}', 'UniversidadesController@remove');
    });
    
    $app->group(['prefix'=>'imagem'], function () use ($app) {
        $app->get('', 'ImagemsController@all');
        $app->get('{id}', 'ImagemsController@get');
    });
    $app->group(['prefix'=>'imagem', 'middleware'=> 'auth'], function () use ($app) {
        $app->post('', 'ImagemsController@UploadImages');
        $app->put('{id}', 'ImagemsController@put');
        $app->delete('{id}', 'ImagemsController@remove');
    });

    $app->group(['prefix'=>'tipo-republica'], function () use ($app) {
        $app->get('', 'TipoRepublicasController@all');
        $app->get('{id}', 'TipoRepublicasController@get');
    });

    $app->group(['prefix'=>'tipo-republica', 'middleware'=> ['auth', 'admin']], function () use ($app) {
        $app->post('', 'TipoRepublicasController@add');
        $app->put('{id}', 'TipoRepublicasController@put');
        $app->delete('{id}', 'TipoRepublicasController@remove');
    });

    $app->group(['prefix'=>'tipo-telefone'], function () use ($app) {
        $app->get('', 'TipoTelefonesController@all');
        $app->get('{id}', 'TipoTelefonesController@get');
    });

    $app->group(['prefix'=>'tipo-telefone', 'middleware'=> ['auth', 'admin']], function () use ($app) {
        $app->post('', 'TipoTelefonesController@add');
        $app->put('{id}', 'TipoTelefonesController@put');
        $app->delete('{id}', 'TipoTelefonesController@remove');
    });

    $app->group(['prefix'=>'republica'], function () use ($app) {
        $app->get('', 'RepublicasController@all');
        $app->get('/buscar', 'RepublicasController@buscarRepublica');
        $app->get('{id}', 'RepublicasController@get');
    });

    $app->group(['prefix'=>'republica', 'middleware'=> 'auth'], function () use ($app) {
        $app->post('', 'RepublicasController@cadastrarRepublica');
        $app->get('user/{id}', 'RepublicasController@getAllByUser');
        $app->put('{id}', 'RepublicasController@put');
        $app->delete('{id}', 'RepublicasController@remove');
    });

    $app->group(['prefix'=>'conveniencia'], function () use ($app) {
        $app->get('', 'ConvenienciasController@all');
        $app->get('{id}', 'ConvenienciasController@get');
    });

    $app->group(['prefix'=>'conveniencia', 'middleware'=> ['auth', 'admin']], function () use ($app) {
        $app->post('', 'ConvenienciasController@add');
        $app->put('{id}', 'ConvenienciasController@put');
        $app->delete('{id}', 'ConvenienciasController@remove');
    });

    $app->group(['prefix'=>'vaga'], function () use ($app) {
        $app->get('', 'VagasController@all');
        $app->get('buscar', 'VagasController@buscarVagas');
        $app->get('{id}', 'VagasController@get');
    });

    $app->group(['prefix'=>'vaga', 'middleware'=> 'auth'], function () use ($app) {
        $app->post('', 'VagasController@cadastrarVaga');
        $app->post('candidatar/{id}', 'VagasController@candidatarVaga');
        $app->put('{id}', 'VagasController@put');
        $app->delete('{id}', 'VagasController@remove');
    });
});


$app->get('/', function () use ($app) {
    return "Api-Documentation para APP iHaus 2017";
});

$app->group(['prefix' => 'admin'], function () use ($app) {
    $app->post('login', 'UsuariosController@loginAdmin');
});
