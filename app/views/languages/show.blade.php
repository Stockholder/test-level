@extends('layouts.scaffold')

@section('main')

<h1>Show Language</h1>

<p>{{ link_to_route('languages.index', 'Return to all languages') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Language</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $language->language }}}</td>
                    <td>{{ link_to_route('languages.edit', 'Edit', array($language->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('languages.destroy', $language->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
