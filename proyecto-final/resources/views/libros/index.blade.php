@extends('dashboard')

@section('main')

<div class="container">
		<h1 class="display-3"><font color="white">Libros</font></h1>
		<a href="{{ route('libros.create')}}" class="btn btn-primary btn-new">Nuevo libro</a>
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
					<th scope="col">ISBN</th>
					<th scope="col">Autor</th>
					<th scope="col" colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($libros as $libro)
					<tr>
						<td>{{ $libro->id }}</td>
						<td>{{ $libro->titulo }}</td>
						<td>{{ $libro->ISBN }}</td>    
						<td>
						@foreach($libro->autors as $autor)
							{{ $autor->nombre }}
							<br>
						@endforeach
						</td>
						<td>
							<a href="{{ route('libros.edit', $libro->id) }}" class="btn btn-primary">Editar</a>
						</td>
						<td>
							<form action="{{ route('libros.destroy', $libro->id) }}" method="post">
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