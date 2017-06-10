<?php session_start() ?>
@extends('layouts.public')

@section('content')

<div class="container">    
            
    <div id="tiporep" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Cadastrar Tipo Republica</div>
            </div>  
            <div class="panel-body" >
                <form id="myForm" >

                    <div id="div_id_desc" class="form-group required">
                        <label for="id_desc" class="control-label col-md-4  requiredField">Descrição<span class="asteriskField">*</span> </label>
                        <div class="controls col-md-8 "> 
                            <input class="input-md textinput textInput form-control" id="id_desc" name="descricao" placeholder="Tipo de República" style="margin-bottom: 10px" type="text" />
                        </div>
                    </div>

                        
                    <div class="form-group"> 
                        <div class="aab controls col-md-4 "></div>
                        <div class="controls col-md-8 ">
                            <input type="submit" name="salvar" value="Salvar" class="btn btn-primary btn btn-info" id="submit-id-salvar" />
                        </div>
                    </div> 

                </form>
            </div>
        </div>
    </div> 
</div>
    
@section('scripts')
<script>
$("#myForm").submit(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: '/api/tipo-republica',
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
      alert(returndata);
    }
  }).done(function( data ) {
      console.log( "Sample of data:" + data );

  });;
 
  return false;
});
</script>
@endsection




</div>            
@endsection
