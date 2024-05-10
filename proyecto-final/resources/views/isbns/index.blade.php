@extends('dashboard')

@section('main')

<div class="container">
		<h1 class="display-3"><font color="white">Libros</font></h1>
		<a href="{{ route('isbn.create')}}" class="btn btn-primary btn-new">Nuevo isbn</a>
		@if(session()->get('success'))
			<div class="alert alert-success" role="alert">
				{{ session()->get('success') }}
			</div>
		@endif
		<table class="table table-dark table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">ISBN</th>
					<th scope="col">Libro</th>
					<th scope="col" colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($isbns as $isbn)
					<tr>
						<td>{{ $isbn->id }}</td>
						<td>{{ $isbn->isbn }}</td>
						<td>{{ $isbn->libro }}</td> 
						<td>
							<a href="{{ route('isbn.edit', $isbn->id) }}" class="btn btn-primary">Editar</a>
						</td>
						<td>
							<form action="{{ route('isbn.destroy', $isbn->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger" type="submit">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection