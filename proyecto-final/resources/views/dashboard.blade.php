<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<x-slot name="header">
				<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
					{{ __('Dashboard') }}
				</h2>
		</x-slot>
			<nav class="navbar navbar-dark bg-dark">
			<div class="container">
				<a class="btn btn-dark" href="/libros">Listar Libros</a>
				<a class="btn btn-dark" href="/libros/create">Nuevo Libro</a>
				<a class="btn btn-dark" href="/autors">Listar Autors</a>
				<a class="btn btn-dark" href="/autors/create">Nuevo Autor</a>
				<a class="btn btn-dark" href="/isbn">Listar ISBN</a>
				<a class="btn btn-dark" href="/isbn/create">Nuevo ISBN</a>
			</div>
			</nav>
		<div class="container">
		@yield('main')
  	</div>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-app-layout>
