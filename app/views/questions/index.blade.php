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
					<td>
						<audio class="audioPath" controls="controls">
							<source src='{{ asset("assets/uploads/".Audio::find($question->audio_id)->path) }}'/>
						</audio>
					</td>
					<td>
						<a href="#myModalAlternative" role="button" class="btn addAlternative" data-toggle="modal" data-id="{{ $question->id }}">Adicionar alternativas</a>
						<a class="btn showAlternatives" data-id="{{ $question->id }}">Mostrar alternativas</a>
					</td>
					<td>
						<a href="#myModal" role="button" class="btn editQuestion" data-toggle="modal" data-id="{{ $question->id }}" data-description="{{{ $question->description }}}" data-audio="{{{ $question->audio_id }}}" data-path="{{{ Audio::find($question->audio_id)->path }}}">Editar questão</a>
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
			<ul class="errors"></ul>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary" id="saveAlternative">Save changes</button>
	</div>
</div>

@stop
