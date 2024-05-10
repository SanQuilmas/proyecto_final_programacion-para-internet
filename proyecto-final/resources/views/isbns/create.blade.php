@extends('dashboard')

@section('main')

<div class="row">
  <div class="col-sm-8 offset-sm-2">
  <h1 class="display-3"><font color="white">Add a ISBN</font></h1>
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
        <form method="post" action="{{ route('isbn.store') }}">
            @csrf
            <label for="isbn"><font color="white">ISBN:</font></label>
                  <input type="text" class="form-control" name="isbn"/>
              </div>

             
              <div class="form-group">
                  <label for="libro"><font color="white">Agregar Libro:</font></label>
              
                <select class="custom-select mr-sm-2" name="libro">
                  <option selected>Choose...</option>
                  @foreach($libros as $libro)
                      <option value="{{ $libro->id }}">
                          {{ $libro->titulo }}
                      </option>
                  @endforeach
                </select>
              </div>

            <button type="submit" class="btn btn-primary">Add ISBN</button>
        </form>
    </div>
  </div>
</div>
@endsection