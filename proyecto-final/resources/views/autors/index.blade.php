@extends('dashboard')

@section('main')

<div class="container">
		<h1 class="display-3"><font color="white">Autors</font></h1>
		<a href="{{ route('autors.create')}}" class="btn btn-primary btn-new">Nuevo autor</a>
		@if(session()->get('success'))
			<div class="alert alert-success" role="alert">
				{{ session()->get('success') }}
			</div>
		@endif
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col" colspan="2">Acciones</th>
				</tr>
			</thead>
			<tbody>
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
			</tbody>
		</table>
	</div>
@endsection