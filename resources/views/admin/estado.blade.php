@section('title')
    {{ 'Cadastrar Estado'}}
@endsection
@extends('layouts.public')
@section('content')
    <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
        <div class="jumbotron">
            <form class="form-inline" id="formEstado" >

                <div class="form-group">
                    <label for="input_descricao">Estado</label>
                    <input required type="text" class="form-control" name="nomeEstado" id="input_descricao" placeholder="Estado">
                </div>

            <button type="submit" class="btn btn-primary">Adicionar novo</button>

            </form>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <table id="tabelaEstado" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th class="">Estado</th>
                    <th class="">Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($estados as $estado)
                <tr>
                    <td style="text-align:center;" class="">{{$estado->id}}</td>
                    <td style="text-align:center;" class="">{{ ucwords($estado->nomeEstado) }}</td>
                    <td style="text-align:center;">
                        <button class="btn btn-success">Editar
                        </button>
                        @if ($estado->cidades->count() > 0)
                            <button class="btn btn-danger"
                                disabled
                                title="Não é possivel deletar pois esse estado tem cidades cadastradas com ele."
                                contenteditable="false">Excluir
                            </button>
                        @else
                            <button class="btn btn-danger"
                                onclick="deleteEstado(this, {{$estado->id}})"
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
    function deleteEstado(r, id){

        var row = r.parentNode.parentNode.rowIndex;

        $.ajax({
        url: "/api/estado/"+id,
        type: "DELETE",
        success: function(data){
            document.getElementById("tabelaEstado").deleteRow(row);
        }
        })
        .done(function(data) {
            console.log(data);
        });
    }

    $("#formEstado").submit(function(event){
        
        //disable the default form submission
        event.preventDefault();
        
        //grab all form data  
        var formData = new FormData($(this)[0]);
        
        $.ajax({
            url: '/api/estado',
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
                console.log("Cadastrado.");
                window.location = "{{ url('/admin/cadastrar/estado') }}";
            }
        }).done(function( data ) {
            console.log( "Resposta:" + JSON.stringify(data) );
            $("#formEstado")[0].reset();
        });;
        
        return false;
    });

</script>
@endsection