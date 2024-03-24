@extends('dashboard')

@section('main')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a libro</h1>
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
      <form method="post" action="{{ route('libros.store') }}">
          @csrf
          <div class="form-group">    
              <label for="titulo">Titulo:</label>
              <input type="text" class="form-control" name="titulo"/>
          </div>

          <div class="form-group">
              <label for="ISBN">ISBN:</label>
              <input type="text" class="form-control" name="ISBN"/>
          </div>

          <div class="form-group">
              <label for="autor">Autor:</label>
              <input type="text" class="form-control" name="autor"/>
          </div>                     
          <button type="submit" class="btn btn-primary-outline">Add Libro</button>
      </form>
  </div>
</div>
</div>
@endsection