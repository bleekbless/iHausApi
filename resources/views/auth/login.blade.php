@extends('layouts.public')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
      <h2>Área do Administrador</h2>

      <form method="post" action="{{ url('/api/usuario/login') }}">
        

        <div class="form-group">
          <label for="exampleInputEmail1">E-mail</label>
          <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="" required>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Senha</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="password" required>
        </div>

        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        </div>
  
      </form>
    </div>
  </div>
</div>
@endsection