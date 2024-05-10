@extends('dashboard')

@section('main')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3"><font color="white">Add a libro</font></h1>
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
              <label for="titulo"><font color="white">Titulo:</font></label>
              <input type="text" class="form-control" name="titulo"/>
          </div>

          <div class="form-group">
                <label for="autor"><font color="white">Autor:</font></label>

                <ul class="list-group" name="autor[]">
                @foreach($autors as $autor)
                    <li class="list-group-item">
                        <input class="form-check-input me-1" name ="autor[]" type="checkbox" value="{{ $autor->id }}">
                        {{ $autor->nombre }}
                    </li>
                @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label for="autor"><font color="white">Agregar ISBN:</font></label>

                <ul class="list-group" name="isbn[]">
                @foreach($isbns as $isbn)
                    <li class="list-group-item">
                        <input class="form-check-input me-1" name ="isbn[]" type="checkbox" value="{{ $isbn->id }}">
                        {{ $isbn->isbn }}
                    </li>
                @endforeach
                </ul>
            </div>

          <button type="submit" class="btn btn-primary">Add Libro</button>
      </form>
  </div>
</div>
</div>
@endsection