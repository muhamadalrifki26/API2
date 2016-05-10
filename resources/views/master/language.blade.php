@extends('app')

@section('content')

<h4>Language</h4>

<table>
	<thead>
		<tr>
			<th>Country ID</th>
			<th>Country Name</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $key)
		<tr>
			<td>{{ $key->code }}</td>
			<td>{{ $key->name_long }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection