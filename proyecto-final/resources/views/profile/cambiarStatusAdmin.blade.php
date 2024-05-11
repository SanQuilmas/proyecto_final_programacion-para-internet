@extends('dashboard')

@section('main')

<div class="container">
		<h1 class="display-3"><font color="white">Datos Removidos</font></h1>
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
					<th scope="col" colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($libros as $libro)
					<tr>
						<td>{{ $libro->id }}</td>
						<td>{{ $libro->titulo }}</td> 
						<td>
							<a href="{{ route('profile.restore', 'libro', $libro->id) }}" class="btn btn-primary">Editar</a>
						</td>
						<td>
							<form action="{{ route('profile.restore', $libro->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger" type="submit">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
				@foreach($autors as $autor)
					<tr>
						<td>{{ $autor->id }}</td>
						<td>{{ $autor->nombre }}</td> 
						<td>
							<a href="{{ route('autors.edit', $autor->id) }}" class="btn btn-primary">Editar</a>
						</td>
						<td>
							<form action="{{ route('autors.destroy', $autor->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger" type="submit">Eliminar</button>
							</form>
						</td>
					</tr>
				@endforeach
				@foreach($isbns as $isbn)
					<tr>
						<td>{{ $isbn->id }}</td>
						<td>{{ $isbn->isbn }}</td> 
						<td>
							<a href="{{ route('isbns.restore', $isbn->id) }}" class="btn btn-primary">Restaurar</a>
						</td>
						<td>
							<form action="{{ route('isbns.destroy', $isbn->id) }}" method="post">
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