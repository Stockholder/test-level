@extends('layouts.alternate')

@section('main')

@if ($questions->count())
	@foreach ($questions as $question)
		<h3>All Questions</h3>
		<table class="table table-striped table-bordered loadedContent">
			<thead>
				<tr>
					<th>Description</th>
					<th>Audio_id</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>{{{ $question->description }}}</td>
					<td>{{{ $question->audio_id }}}</td>
					<td>
						<a href="#myModalAlternative" role="button" class="btn addAlternative" data-toggle="modal" data-id="{{ $question->id }}">Adicionar alternativas</a>
						<a class="btn showAlternatives" data-id="{{ $question->id }}">Mostrar alternativas</a>
					</td>
					<td>
						<a href="#myModal" role="button" class="btn editQuestion" data-toggle="modal" data-id="{{ $question->id }}" data-description="{{{ $question->description }}}" data-audio="{{{ $question->audio_id }}}">Editar questão</a>
					</td>
					<td>
						{{ Form::open(array('method' => 'DELETE', 'route' => array('questions.destroy', $question->id))) }}
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</td>
				</tr>
				<td class="loadAlternatives" data-id="{{ $question->id }}" colspan="7" style="display:none;"></td>
			</tbody>
		</table>
	@endforeach
@else
	There are no questions
@endif

<script>
	$(function () {
		//Show questions
		$('.showAlternatives').click(function(){
			var question_id = $(this).data('id');
			var loadAlternatives = $('.loadAlternatives[data-id="'+question_id+'"]');
			if(loadAlternatives.is(':visible')){
				loadAlternatives.hide();
				$(this).html('Mostrar alternativas');
			}else{
				$(this).html('Ocultar alternativas');
				loadAlternatives.html('');
				loadAlternatives.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
				setTimeout(function(){
					loadAlternatives.load('{{ URL::to('/'); }}/alternatives/showByQuestion/'+question_id);
				},1000);
				
				loadAlternatives.show();
			}
		});
	
	});
	$('.editQuestion').click(function(event) {
		$('#myModalLabelQuestion').html("Editar questão");
		var description = $(this).data('description');
		var audio_id = $(this).data('audio');
		var question_id = $(this).data('id');
		var test_id = $('.editQuestion').parent().parent().parent().parent().parent().data('id');
		$('#formQuestion').find('#description').val(description);
		$('#formQuestion').find('#audio_id').val(audio_id);
		$('#myModal').data('id', test_id);
		$('#myModal').data('question_id', question_id);
	});

	$('.addAlternative').click(function(event) {
		var question_id = $(this).data('id');
		$('#myModalAlternative').data('id', question_id);
	});

	//Modal
	$('#myModalAlternative').on('shown', function() {

	});

	$('#myModalAlternative').on('hidden', function() {
		$('#myModalAlternative').modal('hide');
		$('#errors').html('');
		$('#formAlternative')[0].reset();
	});

	//Save questions
	$("#saveAlternative").bind('click',function () {
		var form = $('#formAlternative');
		var data = form.serialize();
		var method = form.attr('method');
		var url = form.attr('action');
		var question_id = $('#myModalAlternative').data('id');
		var loadAlternatives = $('.loadAlternatives[data-id="'+question_id+'"]');

		data = data+'&question_id='+question_id;
		
		$.ajax({
			type: method,
			url: url,
			data: data
		}).success(function(s) {
			$('#myModalAlternative').modal('toggle');
			$('.showAlternatives[data-id="'+question_id+'"]').html('Ocultar questões');
			loadAlternatives.html('');
			loadAlternatives.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
			setTimeout(function(){
				loadAlternatives.load('{{ URL::to('/'); }}/alternatives/showByQuestion/'+question_id);
			},1000);
			
			loadAlternatives.show();
		}).error(function(e) {
			if(e.status != 400){
				alert('Ocorreu um erro interno, favor consultar o administrador');
			}else{
				$('#errors').html('');
				var errorMessage = JSON.parse(e.responseText);
				var errorPlace = document.createElement('ul');
				errorPlace = $(errorPlace).addClass('errorPlace');
				$.each(errorMessage, function(index, val) {
					$('#errors').append('<li class="error">'+val+'</li>');
				});
			}
		}).done(function( data ) {
			// console.log('done',data);
			})
	});

	// });
</script>

<!-- Modal -->
<div id="myModalAlternative" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Create Question</h3>
	</div>
	<div class="modal-body">
		<p>  
			{{ Form::open(array('route' => 'alternatives.store', 'id' => 'formAlternative')) }}
				<ul>
					<li>
					{{ Form::label('description', 'Description:') }}
					{{ Form::text('description') }}
					</li>
				</ul>
			{{ Form::close() }}
			<ul id="errors"></ul>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary" id="saveAlternative">Save changes</button>
	</div>
</div>

@stop
