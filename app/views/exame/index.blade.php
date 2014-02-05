@extends('layouts.scaffold')
@section('main')
  <style type="text/css">
    p { margin: 0px 0px 10px 0px; }
    input { float: left; width: 50px; }
    label { margin: 0px 0px 0px 10px; float: left; }
    .clearfix:after {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }

    .clearfix {display: inline-block;}

    /* Hides from IE-mac \*/
    * html .clearfix {height: 1%;}
    .clearfix {display: block;}
    /* End hide from IE-mac */
  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $.post('detectSession', '', function(data, textStatus, xhr) {
        if(data.result === 'true'){
          window.location.href = APP_URL+'/inicio';
        }
      },'json'); 
    });
  </script>
  <div class="row-fluid">
    <div class="title span12" style="text-align:center;">
      <p>
        <img style="-webkit-user-select: none; cursor: -webkit-zoom-in;" src="http://www.gpcon.com.br/UserFiles/Logo-Centro-Europeu.png" width="107" height="162">
      </p>
    </div>
  </div>
  <?php 
    $first = key($testes['questions']); 
  ?>
  <div class="row-fluid">
    <div class="title span12" style="text-align:center;">
      <div class="navbar">
        <div class="navbar-inner">
          <a class="brand" href="#">Questão {{ $testes['respondidas']+1 }} de {{ $testes['count']}}</a>
          <ul class="nav pull-right">
            <li>
              <a href="#" class="brand">{{$testes['idioma']}} - {{$testes['filial']}}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="title span12 hero-unit">
      <table class="span6">
        <tr>
          <td>
            <h2>{{$testes['questions'][$first]['question']['description']}}</h2>
          </td>
        </tr>
        <tr>
          <td>
            <audio class="audioPath" controls="controls">
              <source src="{{{ Audio::find($testes['questions'][$first]['question']['audio'])->path }}}"/>
            </audio>
          </td>
        </tr>
        {{ Form::open(array('url' => 'exame', 'method' => 'post'))}}
          <?php foreach ($testes['questions'][$first]['question']['alternatives'] as $key => $value): ?>
            <tr>
              <td>
                <p class="clearfix"> 
                  {{ Form::radio('question', $value['id']); }}
                  <label>{{ $value['description'] }}</label>
                </p>
              </td>
            </tr>
          <?php endforeach; ?>
            <tr>
              <td> 
                {{ Form::submit('Responder', array('class' => 'btn btn-success')); }}
              </td>
            </tr>
        {{ Form::close() }}
      </table>
    </div>
  </div>

@stop