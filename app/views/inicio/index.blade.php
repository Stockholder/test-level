@extends('layouts.scaffold')
@section('main')
  <div class="row-fluid">
    <div class="title span12" style="text-align:center;">
      <p>
        <img style="-webkit-user-select: none; cursor: -webkit-zoom-in;" src="http://www.gpcon.com.br/UserFiles/Logo-Centro-Europeu.png" width="183" height="277">
      </p>
      <br>
      <p>
        <h2>Teste de Nivelamento</h2>
      </p>
      <p>
        {{ Form::open(array('url' => 'processando', 'method' => 'post'))}}
          {{ Form::text('name', null, array('placeholder'=>'Nome')) }}
          <br>
          {{ Form::text('email', null, array('placeholder'=>'Email')) }}
          <br>
          {{ Form::text('telefone', null, array('placeholder'=>'Telefone')) }}
          <br>
          {{ Form::select('idioma', array_merge(array(0 => 'Selecione o idioma'),$languages), 0);}}
          <br>
          {{ Form::select('filial', array_merge(array(0 => 'Selecione a cidade'),$affiliates), 0);}}
          <br>
          {{ Form::submit('Iniciar', array('class' => 'btn btn-primary')); }}
          <button class="btn btn-success">Ajuda</button>
        {{ Form::close() }}
      </p>
    </div>
  </div>
@stop