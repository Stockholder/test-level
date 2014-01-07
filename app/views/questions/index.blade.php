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
					<td>{{ link_to_route('questions.edit', 'Edit', array($question->id), array('class' => 'btn btn-info')) }}</td>
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

		// $('.addQuestion').click(function(event) {
		// 	var test_id = $(this).data('id');
		// 	$('#myModal').data('id', test_id);
		// });

		// //Modal
		// $('#myModal').on('shown', function() {

		// });

		// $('#myModal').on('hidden', function() {
		// 	$('#myModal').modal('hide');
		// 	$('#errors').html('');
		// 	$('#formQuestion')[0].reset();
		// });

	// 	//Save questions
	// 	$("#saveQuestion").bind('click',function () {
	// 		var form = $('#formQuestion');
	// 		var data = form.serialize();
	// 		var method = form.attr('method');
	// 		var url = form.attr('action');
	// 		var test_id = $('#myModal').data('id');
	// 		var loadQuestions = $('.loadQuestions[data-id="'+test_id+'"]');

	// 		data = data+'&test_id='+test_id;
			
	// 		$.ajax({
	// 			type: method,
	// 			url: url,
	// 			data: data
	// 		}).success(function(s) {
	// 			$('#myModal').modal('toggle');
	// 			$('.showQuestions[data-id="'+test_id+'"]').html('Ocultar questões');
	// 			loadQuestions.html('');
	// 			loadQuestions.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
	// 			setTimeout(function(){
	// 				loadQuestions.load('{{ URL::to('/'); }}/questions/showByTest/'+test_id);
	// 			},1000);
				
	// 			loadQuestions.show();
	// 		}).error(function(e) {
	// 			if(e.status != 400){
	// 				alert('Ocorreu um erro interno, favor consultar o administrador');
	// 			}else{
	// 				$('#errors').html('');
	// 				var errorMessage = JSON.parse(e.responseText);
	// 				var errorPlace = document.createElement('ul');
	// 				errorPlace = $(errorPlace).addClass('errorPlace');
	// 				$.each(errorMessage, function(index, val) {
	// 					$('#errors').append('<li class="error">'+val+'</li>');
	// 				});
	// 			}
	// 		}).done(function( data ) {
	// 			// console.log('done',data);
 //  			})
	// 	});

	// });
</script>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Create Question</h3>
	</div>
	<div class="modal-body">
		<p>
			{{ Form::open(array('route' => 'questions.store', 'id' => 'formQuestion')) }}
				<ul>
					<li>
						{{ Form::label('description', 'Description:') }}
						{{ Form::text('description') }}
					</li>

					<li>
						{{ Form::label('audio_id', 'Audio_id:') }}
						{{ Form::input('number', 'audio_id') }}
					</li>
				</ul>
			{{ Form::close() }}
			<ul id="errors"></ul>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary" id="saveQuestion">Save changes</button>
	</div>
</div>

@stop
