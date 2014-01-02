@extends('layouts.scaffold')

@section('main')

<h1>All Affiliates</h1>

<p>{{ link_to_route('affiliates.create', 'Add new affiliate') }}</p>

@if ($affiliates->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>City</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($affiliates as $affiliate)
				<tr>
					<td>{{{ $affiliate->city }}}</td>
                    <td>{{ link_to_route('affiliates.edit', 'Edit', array($affiliate->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('affiliates.destroy', $affiliate->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no affiliates
@endif

@stop
