<?php session_start() ?>
@section('title')
{{ 'Cadastrar Cidade'}}
@endsection
@extends('layouts.public')

@section('content')

    <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
        <div class="jumbotron">
            <form class="form-inline" id="formCidade" >
                <div class="form-group">
                    <label for="input_descricao">Cidade</label>
                    <input required type="text" class="form-control" name="nomeCidade" id="input_descricao" placeholder="Cidade">
                </div>
            
                <div class="form-group">
                <label for="select_cidade">Estado: </label>
                <select required id="select_estado" name="estado_id" class="form-control">
                <option value="">Selecione o Estado-></option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}">{{ ucwords($estado->nomeEstado) }}</option>
                    @endforeach
                </select>
                </div>

            <button type="submit" class="btn btn-primary">Adicionar novo</button>

            </form>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <table id="tabelaCidades" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th class="">Cidade</th>
                    <th class="">Estado</th>
                    <th class="">Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($cidades as $cidade)
                <tr>
                    <td style="text-align:center;" class="">{{$cidade->id}}</td>
                    <td class="">{{ ucwords($cidade->nomeCidade) }}</td>
                    <td style="text-align:center;" class="">{{ ucwords($cidade->estado->nomeEstado) }}</td>
                    <td style="text-align:center;">
                        <button class="btn btn-success" 
                        data-toggle="modal" 
                        data-target="#myModal" 
                        contenteditable="false">Editar
                        </button>
                        @if ($cidade->bairros->count() > 0)
                            <button class="btn btn-danger"
                                disabled
                                title="Não é possivel deletar pois existem estados cadastrados com essa cidade."
                                contenteditable="false">Excluir
                            </button>
                        @else
                            <button class="btn btn-danger"
                                onclick="deleteCidade(this, {{$cidade->id}})"
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
function deleteCidade(r, id){

    var row = r.parentNode.parentNode.rowIndex;

    $.ajax({
    url: "/api/cidade/"+id,
    type: "DELETE",
    headers: {
        'api-token': '{{ $_SESSION['token'] }}'
    },
    success: function(data){
        document.getElementById("tabelaCidades").deleteRow(row);
    }
    })
    .done(function(data) {
        console.log(data);
    });
}

$("#formCidade").submit(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: '/api/cidade',
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
    }
  }).done(function( data ) {
      console.log( "Resposta:" + JSON.stringify(data) );
      $("#formCidade")[0].reset();
  });;
 
  return false;
});


</script>

@endsection