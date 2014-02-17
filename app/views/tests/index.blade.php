@extends('layouts.scaffold')

@section('main')
<style type="text/css">
	.btn-file {
	    position: relative;
	    overflow: hidden;
	}
	.btn-file input[type=file] {
	    position: absolute;
	    top: 0;
	    right: 0;
	    min-width: 100%;
	    min-height: 100%;
	    font-size: 999px;
	    text-align: right;
	    filter: alpha(opacity=0);
	    opacity: 0;
	    background: red;
	    cursor: inherit;
	    display: block;
	}
</style>

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
						<button role="button" class="btn addQuestion" data-toggle="modal" data-id="{{ $test->id }}">Adicionar questões</button>
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

</script>

<!-- Modal -->
<?php /*
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabelQuestion">Create Question</h3>
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
						{{ Form::hidden('path') }}
						<p>
							<span class="btn btn-default btn-file">
								Selecionar audio <input class="btn btn-primary" type="file" id="myaudio"/>
							</span>
							<br>
							<br>
							<div class="audioPathEdit">
								<audio class="audioQuestion" controls="controls">
								</audio>
							</div>
						</p>
						<style type="text/css">
							.btn-file {
							    position: relative;
							    overflow: hidden;
							}
							.btn-file input[type=file] {
							    position: absolute;
							    top: 0;
							    right: 0;
							    min-width: 100%;
							    min-height: 100%;
							    font-size: 999px;
							    text-align: right;
							    filter: alpha(opacity=0);
							    opacity: 0;
							    background: red;
							    cursor: inherit;
							    display: block;
							}
						</style>
					</li>
				</ul>
			{{ Form::close() }}
			<ul class="errors"></ul>
		</p>
	</div>

	*/?>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabelQuestion">Create Question</h3>
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
						{{ Form::hidden('path') }}
					</li>
				</ul>
			{{ Form::close() }}

			{{ Form::open(array( 'id' => 'form_files', 'enctype' => 'multipart/form-data')) }}
				<span class="btn btn-default btn-file">
					Selecionar audio <input class="btn btn-primary" name="file" type="file" id="myaudio"/>
				</span>
				<br /> 
				<progress></progress>
			{{ Form::close() }}
			<div class="audioPathEdit">
				<audio class="audioQuestion" controls="controls"></audio>
			</div>
			<ul class="errors"></ul>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary" id="saveQuestion">Save changes</button>
	</div>
</div>

@stop
