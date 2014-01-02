@extends('layouts.scaffold')

@section('main')

<h1>All Tests</h1>

<p>{{ link_to_route('tests.create', 'Add new test') }}</p>

@if ($tests->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Description</th>
				<th>Languages_id</th>
				<th>Affiliates_id</th>
				<th>Active</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($tests as $test)
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
                    <td>{{ link_to_route('tests.edit', 'Edit', array($test->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('tests.destroy', $test->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no tests
@endif

@stop
