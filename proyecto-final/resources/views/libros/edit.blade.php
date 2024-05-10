@extends('dashboard') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3"><font color="white">Update a libro</font></h1>

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
        <form method="post" action="{{ route('libros.update', $libro->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="titulo"><font color="white">Titulo:</font></label>
                <input type="text" class="form-control" name="titulo" value={{ $libro->titulo }} />
            </div>

            <div class="form-group">
                <label for="autor"><font color="white">Agregar Autor:</font></label>

                <ul class="list-group" name="add-autor[]">
                @foreach($autors as $autor)
                    <li class="list-group-item">
                        <input class="form-check-input me-1" name ="add-autor[]" type="checkbox" value="{{ $autor->id }}">
                        {{ $autor->nombre }}
                    </li>
                @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label for="autor"><font color="white">Eliminar Autor:</font></label>

                <ul class="list-group" name="remove-autor[]">
                @foreach($libro->autors as $autor)
                    <li class="list-group-item">
                        <input class="form-check-input me-1" name ="remove-autor[]" type="checkbox" value="{{ $autor->id }}">
                        {{ $autor->nombre }}
                    </li>
                @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label for="ISBN"><font color="white">ISBN:</font></label>
                <input type="text" class="form-control" name="ISBN" value={{ $libro->ISBN }} />
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection