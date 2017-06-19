@section('title')
{{ 'Cadastrar Universidade'}}
@endsection
@extends('layouts.public')

@section('styles')

<style>
.my-group .form-control{
    width:50%;
}
</style>
@endsection

@section('content')

    <div class="col-md-12" style="margin-bottom:20px">
            <form id="formUniv"  >

                <div class="form-group col-md-3">
                    <label for="input_nome">Universidade</label>
                    <input required type="text" class="form-control" name="nomeUniversidade" id="input_nome" placeholder="Universidade">
                </div>

                <div class="form-group col-md-3">
                    <label for="input_cnpj">CNPJ</label>
                    <input required type="number" required class="form-control" name="cnpj" id="input_cnpj" placeholder="CNPJ">
                </div>

                <div class="form-group col-md-3">
                    <label for="input_cep">CEP</label>
                    <input required type="number" required class="form-control" name="cep" id="input_cep" placeholder="CEP">
                </div>

                <div class="form-group col-md-3">
                    <label for="input_rua">Rua</label>
                    <input disabled required type="text" required class="form-control" name="logradouro" id="input_rua" placeholder="Rua">
                </div>

                <div class="form-group col-md-3">
                    <label for="input_numero">Número</label>
                    <input required type="number" required class="form-control" name="numero" id="input_numero" placeholder="Número">
                </div>

                <div class="form-group col-md-3">
                    <label for="input_bairro">Bairro</label>
                    <input disabled required type="text" required class="form-control" name="bairro" id="input_bairro" placeholder="Bairro">
                </div>

                <div class="form-group col-md-3">
                    <label for="input_cidade">Cidade</label>
                    <input disabled required type="text" required class="form-control" name="cidade" id="input_cidade" placeholder="Cidade">
                </div>

                <div class="form-group col-md-3">
                    <label for="input_estado">Estado</label>
                    <input disabled required type="text" required class="form-control" name="estado" id="input_estado" placeholder="Estado">
                </div>

                    <div class="form-group col-md-3">
                    <label for="input-tel">Telefone</label>
                        <div id="input-tel" class="input-group my-group"> 

                            <input type="tel" required  id="tel" class="form-control" name="numTelefone" placeholder="Número Telefone">
                            <select required id="lunch" class="selectpicker form-control" name="id_tipo" data-live-search="true" title="Selecione um tipo ...">
                                <option>Tipo de Telefone</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                
                <div class="form-group col-md-3 col-md-offset-6">
                    <button type="submit" style="margin-top:20px" class="btn btn-block btn-primary">Adicionar novo</button>
                </div>

            </form>
    </div>

    <div class="col-md-12">
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
                    <td class="">{{ ucwords($universidade->endereco->logradouro) }}</td>
                    <td class="">{{ ucwords($universidade->endereco->numero) }}</td>
                    <td class="">{{ ucwords($universidade->endereco->bairro->nomeBairro) }}</td>
                    <td class="">{{ ucwords($universidade->endereco->bairro->cidade->nomeCidade) }}</td>
                    <td class="">{{ ucwords($universidade->endereco->bairro->cidade->estado->nomeEstado) }}</td>
                    <td class="">{{ ucwords($universidade->telefones->first()->numeroTelefone) }}</td>
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

$( "#input_cep" ).keyup(function() {

    var cep = $(this).val().replace(/\D/g, '');
    if ($("#input_cep").val().length == 8) {

        $("#input_rua").val("...");
        $("#input_bairro").val("...");
        $("#input_cidade").val("...");
        $("#input_estado").val("...");  

        $.getJSON("http://api.postmon.com.br/v1/cep/" + cep, function(dados){
           
            $("#input_rua").val(dados.logradouro);
            $("#input_bairro").val(dados.bairro);
            $("#input_cidade").val(dados.cidade);
            $("#input_estado").val(dados.estado_info.nome);
        });    
    }

});

function deleteUniversidade(u, id){

    var row = u.parentNode.parentNode.rowIndex;

    $.ajax({
    url: "/api/universidade/"+id,
    type: "DELETE",
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

  var endereco = {
      "logradouro" : $("#input_rua").val(),
      "bairro" : $("#input_bairro").val(),
      "cidade" : $("#input_cidade").val(),
      "estado" : $("#input_estado").val(),
      "numero" : $("#input_numero").val()
  }

  

  formData.append('endereco', JSON.stringify(endereco));

  console.log(endereco);
  $.ajax({
    url: '/api/universidade',
    type: 'POST',
    data: formData,
    async: true,
    cache: false,
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