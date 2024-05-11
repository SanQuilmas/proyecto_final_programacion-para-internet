@extends('dashboard')

@section('main')

<div class="container">
		<h1 class="display-3"><font color="white">Datos Removidos</font></h1>
		@if(session()->get('success'))
			<div class="alert alert-success" role="alert">
				{{ session()->get('success') }}
			</div>
		@endif
		<table class="table table-dark table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Título</th>
					<th scope="col">Tipo de Dato</th>
					<th scope="col" colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($libros as $libro)
					<tr>
						<td>{{ $libro->id }}</td>
						<td>{{ $libro->titulo }}</td> 
						<td>Libro</td> 
						<td>
							<a href="{{ route('profile.restore', ['op' => 'libro', 'id' => $libro->id]) }}" class="btn btn-primary">Restaurar</a>
						</td>
						<td>
							<a href="{{ route('profile.forceDelete', ['op' => 'libro', 'id' => $libro->id]) }}" class="btn btn-danger">Eliminar</a>
						</td>
					</tr>
				@endforeach
				@foreach($autors as $autor)
					<tr>
						<td>{{ $autor->id }}</td>
						<td>{{ $autor->nombre }}</td> 
						<td>Autor</td> 
						<td>
							<a href="{{ route('profile.restore', ['op' => 'autor', 'id' => $autor->id]) }}" class="btn btn-primary">Restaurar</a>
						</td>
						<td>
							<a href="{{ route('profile.forceDelete', ['op' => 'autor', 'id' => $autor->id]) }}" class="btn btn-danger">Eliminar</a>
						</td>
					</tr>
				@endforeach
				@foreach($isbns as $isbn)
					<tr>
						<td>{{ $isbn->id }}</td>
						<td>{{ $isbn->isbn }}</td> 
						<td>ISBN</td> 
						<td>
							<a href="{{ route('profile.restore', ['op' => 'isbn', 'id' => $isbn->id]) }}" class="btn btn-primary">Restaurar</a>
						</td>
						<td>
							<a href="{{ route('profile.forceDelete', ['op' => 'isbn', 'id' => $isbn->id]) }}" class="btn btn-danger">Eliminar</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection