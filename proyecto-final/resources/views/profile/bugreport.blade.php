@extends('dashboard')

@section('main')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
		<h1 class="display-3"><font color="white">Llenar BugReport</font></h1>
	<div>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
				</ul>
			</div><br />
		@endif
			<form method="post" action="{{ route('profile.sendBugreport') }}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">    
					<label for="content"><font color="white">Escribe sus quejas o sugerencias</font></label>
				<textarea class="form-control" id="content" rows="3" name="content" required></textarea>
					</div>

					<button type="submit" class="btn btn-primary">Enviar Correo</button>
			</form>
	</div>
</div>
</div>
@endsection