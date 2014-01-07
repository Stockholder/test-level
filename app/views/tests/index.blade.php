@extends('layouts.scaffold')

@section('main')

<h1>All Tests</h1>

<p>{{ link_to_route('tests.create', 'Add new test') }}</p>

@if ($tests->count())

	@foreach ($tests as $test)
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Description</th>
					<th>Languages_id</th>
					<th>Affiliates_id</th>
					<th>Active</th>
					<th align="center">Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>{{{ $test->description }}}</td>
					<td>{{{ Language::find($test->languages_id)->language }}}</td>
					<td>{{{ Affiliate::find($test->affiliates_id)->city }}}</td>
					<td>
						@if ($test->active == 1)
							<span class="label label-success">Ativo</span>
						@else
							<span class="label label-danger">Inativo</span>
						@endif
					</td>
					<td>
						<a href="#myModal" role="button" class="btn addQuestion" data-toggle="modal" data-id="{{ $test->id }}">Adicionar questões</a>
						<a class="btn showQuestions" data-id="{{ $test->id }}">Mostrar questões</a>
					</td>
					<td>{{ link_to_route('tests.edit', 'Edit', array($test->id), array('class' => 'btn btn-info')) }}</td>
					<td>
						{{ Form::open(array('method' => 'DELETE', 'route' => array('tests.destroy', $test->id))) }}
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</td>
				</tr>
				<tr>
					<td class="loadQuestions" data-id="{{ $test->id }}" colspan="7" style="display:none;"></td>
				</tr>
			</tbody>
		</table>
	@endforeach

@else
	There are no tests
@endif

<script>
	$(function () {
		//Show questions
		$('.showQuestions').click(function(){
			var test_id = $(this).data('id');
			var loadQuestions = $('.loadQuestions[data-id="'+test_id+'"]');
			if(loadQuestions.is(':visible')){
				loadQuestions.hide();
				$(this).html('Mostrar questões');
			}else{
				$(this).html('Ocultar questões');
				loadQuestions.html('');
				loadQuestions.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
				setTimeout(function(){
					loadQuestions.load('{{ URL::to('/'); }}/questions/showByTest/'+test_id);
				},1000);
				
				loadQuestions.show();
			}
		});

		$('.addQuestion').click(function(event) {
			var test_id = $(this).data('id');
			$('#myModal').data('id', test_id);
		});

		//Modal
		$('#myModal').on('shown', function() {

		});

		$('#myModal').on('hidden', function() {
			$('#myModal').modal('hide');
			$('#errors').html('');
			$('#formQuestion')[0].reset();
		});

		//Save questions
		$("#saveQuestion").bind('click',function () {
			var form = $('#formQuestion');
			var data = form.serialize();
			var method = form.attr('method');
			var url = form.attr('action');
			var test_id = $('#myModal').data('id');
			var loadQuestions = $('.loadQuestions[data-id="'+test_id+'"]');

			data = data+'&test_id='+test_id;
			
			$.ajax({
				type: method,
				url: url,
				data: data
			}).success(function(s) {
				$('#myModal').modal('toggle');
				$('.showQuestions[data-id="'+test_id+'"]').html('Ocultar questões');
				loadQuestions.html('');
				loadQuestions.append($('<div style="text-align:center"><img src="http://ri.magazineluiza.com.br/rao2012/images/loader.gif" width="100" height="100"/></div>'));
				setTimeout(function(){
					loadQuestions.load('{{ URL::to('/'); }}/questions/showByTest/'+test_id);
				},1000);
				
				loadQuestions.show();
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

	});
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
