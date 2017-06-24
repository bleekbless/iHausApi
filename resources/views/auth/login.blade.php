@extends('layouts.public')

@section('styles')
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Vibur);
    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      font-family: arial;
    }

    body {
      background: #FF9000;
    }

    h1 {
      color: #ccc;
      text-align: center;
      font-family: 'Vibur', cursive;
      font-size: 80px;
    }

    .login-form {
      width: 350px;
      padding: 40px 30px;
      background: #eee;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      border-radius: 4px;
      margin: auto;
      position: absolute;
      left: 0;
      right: 0;
      top: 50%;
      -moz-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
    }

    .form-group {
      position: relative;
      margin-bottom: 15px;
    }

    .form-control {
      width: 100%;
      height: 50px;
      border: none;
      padding: 5px 7px 5px 15px;
      background: #fff;
      color: #666;
      border: 2px solid #ddd;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      border-radius: 4px;
    }
    .form-control:focus, .form-control:focus + .fa {
      border-color: #10CE88;
      color: #10CE88;
    }

    .form-group .fa {
      position: absolute;
      right: 15px;
      top: 17px;
      color: #999;
    }

    .log-status.wrong-entry {
      -moz-animation: wrong-log 0.3s;
      -webkit-animation: wrong-log 0.3s;
      animation: wrong-log 0.3s;
    }

    .log-status.wrong-entry .form-control, .wrong-entry .form-control + .fa {
      border-color: #ed1c24;
      color: #ed1c24;
    }

    .log-btn {
      background: #0AC986;
      dispaly: inline-block;
      width: 100%;
      font-size: 16px;
      height: 50px;
      color: #fff;
      text-decoration: none;
      border: none;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      border-radius: 4px;
    }

    .link {
      text-decoration: none;
      color: #C6C6C6;
      float: right;
      font-size: 12px;
      margin-bottom: 15px;
    }
    .link:hover {
      text-decoration: underline;
      color: #8C918F;
    }

    .alert {
      display: none;
      font-size: 12px;
      color: #f00;
      float: left;
    }

    @-moz-keyframes wrong-log {
      0%, 100% {
        left: 0px;
      }
      20% , 60% {
        left: 15px;
      }
      40% , 80% {
        left: -15px;
      }
    }
    @-webkit-keyframes wrong-log {
      0%, 100% {
        left: 0px;
      }
      20% , 60% {
        left: 15px;
      }
      40% , 80% {
        left: -15px;
      }
    }
    @keyframes wrong-log {
      0%, 100% {
        left: 0px;
      }
      20% , 60% {
        left: 15px;
      }
      40% , 80% {
        left: -15px;
      }
    }
  </style>

@endsection

@section('content')
  <div class="login-form">
    <h1><i class="fa fa-home"></i>iHaus</h1>
    <form method="post" id="form_login" action="#">
      <div class="form-group ">
        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="" required>
          <i class="fa fa-user"></i>
      </div>
      <div class="form-group log-status">
        <input type="password" class="form-control" id="password" placeholder="Senha" name="password" required>
          <i class="fa fa-lock"></i>
      </div>
      <span class="alert"></span>
      <a class="link" href="#">Esqueceu a senha?</a>

      <button type="submit" class="log-btn" >Log in</button>
    </form>
  </div>

@endsection

@section('scripts')

<script>
  const API_LOGIN = '/api/usuario/login';

    $(document).ready(function(){
      $('#form_login').submit(function(event){
        event.preventDefault();
        $('.alert').empty();
        var response = '';
        
        $.post( API_LOGIN, function(data) {

          

        }).fail(function(data) {
          
          response = $.parseJSON(data.responseText).error;
          
            $('.alert').append(response);
            $('.log-status').addClass('wrong-entry');
            $('.alert').fadeIn(500);
            setTimeout( "$('.alert').fadeOut(700);",2000 );
          });
      });

        $('.form-control').keypress(function(){
          $('.log-status').removeClass('wrong-entry');
        });

    });
</script>

@endsection