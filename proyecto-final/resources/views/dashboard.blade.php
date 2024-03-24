<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		    <link href="/css/app" rel="stylesheet">
		<x-slot name="header">
				<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
						{{ __('Dashboard') }}
				</h2>
		</x-slot>
			<a>
				<div class="navbar">
					<a href="/libros">Listar Libros</a>
					<a href="/libros/create">Nuevo Libro</a>
				</div>
			</a>
		<div class="container">
		@yield('main')
  	</div>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-app-layout>
