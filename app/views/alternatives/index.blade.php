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

@stop
