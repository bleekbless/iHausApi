<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="@yield('author')">
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="token" content="<?php if(isset($token)){echo $token;} ?>">

    <title>@yield('title', 'Haus')</title>

    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"></script>

    @yield('styles')
    @yield('head')
</head>
<body>
    @section('header')
        <nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Admin Haus</a>
        </div>

        @if(!Auth::check())
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="dropdown">
            <a href="#" 
            class="dropdown-toggle" 
            data-toggle="dropdown" 
            role="button" 
            aria-haspopup="true" aria-expanded="false">Cadastrar <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/cadastrar/tipo-republica?token=<?php if(isset($token)){echo $token;} ?>">Tipo Republica</a></li>
                <li><a href="/admin/cadastrar/cidade">Cidade</a></li>
                <li><a href="/admin/cadastrar/estado">Estado</a></li>
                <li><a href="/admin/cadastrar/bairro">Bairro</a></li>
                <li><a href="/admin/cadastrar/conveniencia">Conveniencia</a></li>
                <li><a href="/admin/cadastrar/universidade">Universidade</a></li>
                <li><a href="/admin/cadastrar/tipo-telefone">Tipo Telefone</a></li>     
            </ul>
            </li>
        </ul>
        @endif
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="/api/usuario/logout">Sair</a></li>
            </ul>
            </li>
        </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
    @show

    @yield('content')
 

    @section('footer')
    @show

  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  @yield('scripts')
</body>
</html>