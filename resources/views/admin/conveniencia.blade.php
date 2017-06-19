@section('title')
{{ 'Cadastrar Conveniencia'}}
@endsection
@extends('layouts.public')

@section('content')

    <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
        <div class="jumbotron">
            <form class="form-inline" id="formConv" >

                <div class="form-group">
                    <label for="input_descricao">Conveniência</label>
                    <input required type="text" class="form-control" name="descricaoConveniencia" id="input_descricao" placeholder="Conveniência">
                </div>

            <button type="submit" class="btn btn-primary">Adicionar novo</button>

            </form>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <table id="tabelaConveniencia" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th class="">Descrição</th>
                    <th class="">Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($conveniencias as $conv)
                <tr>
                    <td style="text-align:center;" class="">{{$conv->id}}</td>
                    <td class="">{{ ucwords($conv->descricaoConveniencia) }}</td>
                    <td style="text-align:center;">
                        <button class="btn btn-success">Editar
                        </button>
                        @if ($conv->republicas->count() > 0)
                            <button class="btn btn-danger"
                                disabled
                                title="Não é possivel deletar pois existem republicas com essa conveniência."
                                contenteditable="false">Excluir
                            </button>
                        @else
                            <button class="btn btn-danger"
                                onclick="deleteConveniencia(this, {{$conv->id}})"
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
function deleteConveniencia(r, id){

    var row = r.parentNode.parentNode.rowIndex;

    $.ajax({
    url: "/api/conveniencia/"+id,
    type: "DELETE",
    success: function(data){
        document.getElementById("tabelaConveniencia").deleteRow(row);
    }
    })
    .done(function(data) {
        console.log(data);
    });
}

$("#formConv").submit(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: '/api/conveniencia',
    type: 'POST',
    data: formData,
    async: true,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
        console.log("Cadastrado.");
        window.location = "{{ url('/admin/cadastrar/conveniencia') }}";
    }
  }).done(function( data ) {
      console.log( "Resposta:" + JSON.stringify(data) );
      $("#formConv")[0].reset();
  });;
 
  return false;
});


</script>

@endsection