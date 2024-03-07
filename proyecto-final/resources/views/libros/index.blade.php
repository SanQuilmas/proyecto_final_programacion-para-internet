@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Libros</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Titulo</td>
          <td>ISBN</td>
          <td>Autor</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
        <div>
            <a style="margin: 19px;" href="{{ route('libros.create')}}" class="btn btn-primary">New libro</a>
        </div>
    <tbody>
        @foreach($libros as $libro)
        <tr>
            <td>{{$libro->id}}</td>
            <td>{{$libro->titulo}}</td>
            <td>{{$libro->ISBN}}</td>
            <td>{{$libro->autor}}</td>
            <td>
                <a href="{{ route('libros.edit',$libro->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('libros.destroy', $libro->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>

<div class="col-sm-12">
@if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div>
@endif
</div>

</div>
@endsection