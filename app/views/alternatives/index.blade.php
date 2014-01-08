@extends('layouts.alternate')

@section('main')

@if ($alternatives->count())
	<h4>All Alternatives</h4>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Description</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($alternatives as $alternative)
				<tr>
					<td>{{{ $alternative->description }}}</td>
					<td>{{ link_to_route('alternatives.edit', 'Edit', array($alternative->id), array('class' => 'btn btn-info')) }}</td>
					<td>
						{{ Form::open(array('method' => 'DELETE', 'route' => array('alternatives.destroy', $alternative->id))) }}
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</td>
					<td>
						<?php 
							$result = DB::table('alternative_question')->where('alternative_id', $alternative->id)->get();
						?>
						@if ($result[0]->correct  == 1)
							<span class="btn btn-mini btn-success changeCorrect" data-option="1" data-question="{{ $result[0]->question_id }}" data-id="{{ $alternative->id }}">Correta</span>
						@else
							<span class="btn btn-mini btn-danger changeCorrect" data-option="1" data-question="{{ $result[0]->question_id }}"  data-id="{{ $alternative->id }}">Incorreta</span>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no alternatives
@endif
<script type="text/javascript">
	$('.changeCorrect').click(function(event) {
		var option = $(this).data('option');
		var alternative_id = $(this).data('id');
		var question_id = $(this).data('question');
		var url = '{{ URL::to('/'); }}/alternatives/changeCorrect';
		var method = 'POST';
		var data = {'alternative_id' : alternative_id, 'option' : option, 'question_id': question_id };
		var loadAlternatives = $('.loadAlternatives[data-id="'+question_id+'"]');
		$.ajax({
			type: method,
			url: url,
			data: data
		}).success(function(s) {
			loadAlternatives.html('');
			loadAlternatives.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
			setTimeout(function(){
				loadAlternatives.load('{{ URL::to('/'); }}/alternatives/showByQuestion/'+question_id);
			},1000);
		}).error(function(e) {
			alert('Ocorreu um erro interno, favor consultar o administrador');
		}).done(function( data ) {

		});
	});

</script>
@stop
