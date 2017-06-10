<?php session_start() ?>
@extends('layouts.public')

@section('content')


<div class="row">
    <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
        <div class="jumbotron">
            <form class="form-inline" id="formBairro" >
                <div class="form-group">
                    <label for="input_descricao">Bairro</label>
                    <input required type="text" class="form-control" name="nomeBairro" id="input_descricao" placeholder="Descrição">
                </div>
            
                <div class="form-group">
                <label for="select_cidade">Cidade: </label>
                <select required id="select_cidade" name="cidade_id" class="form-control">
                <option value="">Selecione a cidade-></option>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}">{{ ucwords($cidade->nomeCidade) }}</option>
                    @endforeach
                </select>
                </div>

            <button type="submit" class="btn btn-primary">Adicionar novo</button>

            </form>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <table id="tabelaBairros" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th class="">Bairro</th>
                    <th class="">Cidade</th>
                    <th class="">Estado</th>
                    <th class="">Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bairros as $bairro)
                <tr>
                    <td style="text-align:center;" class="">{{$bairro->id}}</td>
                    <td class="">{{ ucwords($bairro->nomeBairro) }}</td>
                    <td style="text-align:center;" class="">{{ ucwords($bairro->cidade->nomeCidade) }}</td>
                    <td style="text-align:center;" class="">{{ ucwords($bairro->cidade->estado->nomeEstado) }}</td>
                    <td style="text-align:center;">
                        <button class="btn btn-success" 
                        data-toggle="modal" 
                        data-target="#myModal" 
                        contenteditable="false">Editar
                        </button>
                        @if ($bairro->enderecos->count() > 0)
                            <button class="btn btn-danger"
                                disabled
                                title="Não é possivel deletar pois existem endereços cadastrados com esse bairro."
                                contenteditable="false">Excluir
                            </button>
                        @else
                            <button class="btn btn-danger"
                                onclick="deleteBairro(this, {{$bairro->id}})"
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Editar</h4>

            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
function deleteBairro(r, id){

    var row = r.parentNode.parentNode.rowIndex;

    $.ajax({
    url: "/api/bairro/"+id,
    type: "DELETE",
    headers: {
        'api-token': '{{ $_SESSION['token'] }}'
    },
    success: function(data){
        document.getElementById("tabelaBairros").deleteRow(row);
    }
    })
    .done(function(data) {
        console.log(data);
    });
}

$("#formBairro").submit(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: '/api/bairro',
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
      $("#formBairro")[0].reset();
  });;
 
  return false;
});

$(".btn[data-target='#myModal']").click(function() {
       var columnHeadings = $("thead th").map(function() {
                 return $(this).text();
              }).get();
       columnHeadings.pop();
       var columnValues = $(this).parent().siblings().map(function() {
                 return $(this).text();
       }).get();
  var modalBody = $('<div id="modalContent"></div>');
  var modalForm = $('<form role="form" name="modalForm"></form>');
  $.each(columnHeadings, function(i, columnHeader) {
       var formGroup = $('<div class="form-group"></div>');
       formGroup.append('<label for="'+columnHeader+'">'+columnHeader+'</label>');

       if(columnHeader == 'ID'){
        formGroup.append('<input class="form-control" disabled name="nome'+columnHeader+'" id="'+columnHeader+i+'" value="'+columnValues[i]+'" />');            
       }else{
         formGroup.append('<input class="form-control" name="nome'+columnHeader+'" id="'+columnHeader+i+'" value="'+columnValues[i]+'" />');            
       }
       modalForm.append(formGroup);
  });
  modalBody.append(modalForm);
  $('.modal-body').html(modalBody);
});
$('.modal-footer .btn-primary').click(function() {
   $('form[name="modalForm"]').submit();
});

</script>

@endsection