<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>tete</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="http://code.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
		<!--Script-->
		<script type="text/javascript">
            function carregarItens(){
                //variáveis
                 url = "http://localhost:3000/api/conveniencia";

                //Capturar Dados Usando Método AJAX do jQuery
                $.ajax({
                    url: url,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                        $("h2").html("Carregando..."); //Carregando
                    },
                    error: function() {
                        $("h2").html("Há algum problema com a fonte de dados");
                    },
                    success: function(retorno) {
                        if(retorno[0].erro){
                            $("h2").html(retorno[0].erro);
                        }
                        else{
                            var itens = ""
                            //Laço para criar linhas da tabela
                        for (var x = 0; x < retorno.length; x++) {
                            itens += '<input type="checkbox" name="conveniencias[]" value="' + retorno[x][
                                    'id'] + '">' + retorno[x]['descricaoConveniencia'] +
                                '</input>';
                        }
                        $('#conv')
                            .html(itens);
                            
                            //Limpar Status de Carregando
                            $("h2").html("Carregado");
                        }
                    }
                });

                $.ajax({
                    url: "http://localhost:3000/api/universidade",
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                        $("h2").html("Carregando..."); //Carregando
                    },
                    error: function() {
                        $("h2").html("Há algum problema com a fonte de dados");
                    },
                    success: function(retorno) {
                        if(retorno[0].erro){
                            $("h2").html(retorno[0].erro);
                        }
                        else{
                            var univ = ""
                            //Laço para criar linhas da tabela
                        for (var x = 0; x < retorno.length; x++) {
                            univ += '<option value="' + retorno[x][
                                    'id'] + '">' + retorno[x]['nomeUniversidade'] +
                                '</option>';
                        }
                        $('#univ')
                            .html(univ);
                            
                            //Limpar Status de Carregando
                            $("h2").html("Carregado");
                        }
                    }
                });
            }
        </script>
    </head>


    <body onload="carregarItens()">
        
        <form action="http://localhost:3000/api/republica" method="POST" enctype="multipart/form-data" >
            <input type="file" name="imagens[]" multiple >
            <br>
            <h2></h2>
            <label for="nomeRepublica">nomeRepublica</label>
            <input type="text" name="nomeRepublica">
            <label for="curso">curso</label>
            <input type="text" name="curso">
            <label for="quantidadeQuartos">quantidadeQuartos</label>
            <input type="number" name="quantidadeQuartos">
            <label for="quantidadeMoradores">quantidadeMoradores</label>
            <input type="text" name="quantidadeMoradores" >
            <label for="descricao">descricao</label>
            <input type="text" name="descricao">
            
            <input type="hidden" name="tipo_republica" value="1">
            <input type="hidden" name="endereco" value="1">
            <input type="hidden" name="usuario_id" value="5">

            <div id="conv"> </div>
            <select id="univ" name="universidade"> </select>
            <input type="hidden" name="api-token" value="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6ImM3NDczYTRkMjZiOTk4Zjg3OWQzNTlmYWJjYTI2ZjM1In0.eyJpc3MiOiJodHRwOlwvXC93d3cuaWhhdXMuZXN5LmVzIiwiYXVkIjoiaHR0cDpcL1wvd3d3LmloYXVzLmVzeS5lcyIsImp0aSI6ImM3NDczYTRkMjZiOTk4Zjg3OWQzNTlmYWJjYTI2ZjM1IiwiaWF0IjoxNDk2MzIxNDUyLCJ1aWQiOjV9.yeW-eNh8Id2XFlRjdbp0rg-8vXle-GOWsi2Bve_WTOI" >
            <button type="submit">enviar</button>
        </form>

        
    </body>
</html>
