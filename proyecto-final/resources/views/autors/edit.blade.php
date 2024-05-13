@extends('dashboard') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3"><font color="white">Update a autor</font></h1>

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
        <form method="post" action="{{ route('autors.update', $autor->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="nombre"><font color="white">Nombre:</font></label>
                <input type="text" class="form-control" name="nombre" value={{ $autor->nombre }} required/>
            </div>

            <div class="form-group">
                <label for="autor"><font color="white">Agregar Libro:</font></label>

                <ul class="list-group" name="add-libro[]">
                @foreach($libros as $libro)
                    <li class="list-group-item">
                        <input class="form-check-input me-1" name ="add-libro[]" type="checkbox" value="{{ $libro->id }}">
                        {{ $libro->titulo }}
                    </li>
                @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label for="autor"><font color="white">Eliminar Libro:</font></label>

                <ul class="list-group" name="remove-libro[]">
                @foreach($autor->libros as $libro)
                    <li class="list-group-item">
                        <input class="form-check-input me-1" name ="remove-libro[]" type="checkbox" value="{{ $libro->id }}">
                        {{ $libro->titulo }}
                    </li>
                @endforeach
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection