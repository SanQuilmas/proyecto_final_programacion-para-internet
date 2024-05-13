@extends('dashboard') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3"><font color="white">Update a ISBN</font></h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('isbn.update', $isbn->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="isbn"><font color="white">ISBN:</font></label>
                <input type="text" class="form-control" name="isbn" value={{ $isbn->isbn }} required/>
            </div>

                <div class="form-group">
                  <label for="libro"><font color="white">Cambiar Libro:</font></label>
              
                <select class="custom-select mr-sm-2" name="libro" required>
                  <option selected disabled value="">Choose...</option>
                  @foreach($libros as $libro)
                      <option value="{{ $libro->id }}">
                          {{ $libro->titulo }}
                      </option>
                  @endforeach
                </select>
              </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection