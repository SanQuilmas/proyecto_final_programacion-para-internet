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
            <label for="isbn"><font color="white">ISBN:</font></label>
                  <input type="text" class="form-control" name="isbn"/>
              </div>

              <div class="form-group">
                  <label for="libro"><font color="white">Agregar Libro:</font></label>

                  <ul class="list-group" name="add-libro[]">
                  @foreach($libros as $libro)
                      <li class="list-group-item">
                          <input class="form-check-input me-1" name ="add-libro[]" type="checkbox" value="{{ $libro->id }}">
                          {{ $libro->nombre }}
                      </li>
                  @endforeach
                  </ul>
              </div>

            <button type="submit" class="btn btn-primary">Add ISBN</button>
        </form>
    </div>
  </div>
</div>
@endsection