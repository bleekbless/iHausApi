<?php session_start() ?>
@section('title')
{{ 'Cadastrar Universidade'}}
@endsection
@extends('layouts.public')

@section('content')

    <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
        <div class="jumbotron">
            <form id="formUniv" >

                <div class="form-group">
                    <label for="input_nome">Universidade</label>
                    <input required type="text" class="form-control" name="nomeUniversidade" id="input_nome" placeholder="Universidade">
                </div>

                <div class="form-group">
                    <label for="input_cnpj">CNPJ</label>
                    <input required type="text" required class="form-control" name="nomeUniversidade" id="input_cnpj" placeholder="Universidade">
                </div>

                <div class="form-group">
                    <label for="input_cep">CEP</label>
                    <input required type="number" required class="form-control" name="cep" id="input_cep" placeholder="CEP">
                </div>

                <div class="form-group">
                    <label for="input_rua">Rua</label>
                    <input required type="text" required class="form-control" name="logradouro" id="input_rua" placeholder="Rua">
                </div>

                <div class="form-group">
                    <label for="input_numero">Número</label>
                    <input required type="number" required class="form-control" name="numero" id="input_numero" placeholder="Número">
                </div>

                <div class="form-group">
                    <label for="input_bairro">Bairro</label>
                    <input required type="text" required class="form-control" name="bairro" id="input_bairro" placeholder="Bairro">
                </div>

                <div class="form-group">
                    <label for="input_cidade">Cidade</label>
                    <input required type="text" required class="form-control" name="cidade" id="input_cidade" placeholder="Cidade">
                </div>

                <div class="form-group">
                    <label for="input_estado">Estado</label>
                    <input required type="text" required class="form-control" name="estado" id="input_estado" placeholder="Estado">
                </div>

                <div class="form-group">
                    <label for="input_contato">Telefone</label>
                    <input required type="tel" class="form-control" name="numTelefone" id="input_contato" placeholder="Telefone">
                </div>

            <button type="submit" class="btn btn-primary">Adicionar novo</button>

            </form>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <table id="tabelaUniversidade" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th class="">Nome</th>
                    <th class="">CNPJ</th>
                    <th class="">Rua</th>
                    <th class="">Número</th>
                    <th class="">Bairro</th>
                    <th class="">Cidade</th>
                    <th class="">Estado</th>
                    <th class="">Contato</th>
                    <th class="">Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($universidades as $universidade)
                <tr>
                    <td style="text-align:center;" class="">{{$universidade->id}}</td>
                    <td class="">{{ ucwords($universidade->nomeUniversidade) }}</td>
                    <td class="">{{ ucwords($universidade->cnpj) }}</td>
                    <td class="">{{ ucwords($universidade)->endereco->logradouro }}</td>
                    <td class="">{{ ucwords($universidade)->endereco->numero }}</td>
                    <td class="">{{ ucwords($universidade)->endereco->bairro->nomeBairro }}</td>
                    <td class="">{{ ucwords($universidade)->endereco->bairro->cidade->nomeCidade }}</td>
                    <td class="">{{ ucwords($universidade)->endereco->bairro->cidade->estado->nomeEstado }}</td>
                    <td class="">{{ ucwords($universidade)->telefone->numero }}</td>
                    <td style="text-align:center;">
                        <button class="btn btn-success">Editar
                        </button>
                        @if ($universidade->republicas->count() > 0)
                            <button class="btn btn-danger"
                                disabled
                                title="Não é possivel deletar pois existem repúblicas cadastradas nessa univerisdade."
                                contenteditable="false">Excluir
                            </button>
                        @else
                            <button class="btn btn-danger"
                                onclick="deleteUniversidade(this, {{$universidade->id}})"
                                contenteditable="false">Excluir
                            </button>
                        @endif
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')

<script>
function deleteUniversidade(u, id){

    var row = u.parentNode.parentNode.rowIndex;

    $.ajax({
    url: "/api/universidade/"+id,
    type: "DELETE",
    headers: {
        'api-token': '{{ $_SESSION['token'] }}'
    },
    success: function(data){
        document.getElementById("tabelaUniversidade").deleteRow(row);
    }
    })
    .done(function(data) {
        console.log(data);
    });
}

$("#formUniv").submit(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: '/api/universidade',
    type: 'POST',
    data: formData,
    async: true,
    cache: false,
    headers: {
        'api-token': '{{ $_SESSION['token'] }}'
    },
    contentType: false,
    processData: false,
    success: function (returndata) {
        console.log("Cadastrado.");
        window.location = "{{ url('/admin/cadastrar/universidade') }}";
    }
  }).done(function( data ) {
      console.log( "Resposta:" + JSON.stringify(data) );
      $("#formUniv")[0].reset();
  });;
 
  return false;
});


</script>

@endsection