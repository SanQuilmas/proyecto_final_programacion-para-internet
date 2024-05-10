<?php

namespace App\Http\Controllers;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\autor_libros;
use App\Models\ISBN;

use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isbns = ISBN::with('libro')->get();
        $autors = Autor::with('libros')->get();
        $libros = Libro::all();

        return view('libros.index', compact('libros'), compact('autors'), compact('isbns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $isbns = ISBN::all();
        $autors = Autor::all();
        return view('libros.create', compact('autors'), compact('isbns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>'required',
        ]);

        $libro = new Libro;
        $libro->titulo = $request->get('titulo');
        if($request->get('ISBN') == null){
            $libro->isbn_id = 0;
        }else{
            $libro->isbns()->save($request->get('ISBN'));
        }
        
        $libro->save();

        $autors = $request->get('autor');

        if($autors != null){
            foreach($autors as $autor)
                $libro->autors()->attach($autor);
        }
        return redirect('/libros')->with('success', 'Libro saved!');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $isbns = ISBN::all();
        $autors = Autor::all();
        $libro = Libro::find($id);
        return view('libros.edit', compact('libro', 'autors', 'isbns'));
    }

    public function update(Request $request, string $id)
    {
        $flag = True;
        $flagISBN = True;
        $request->validate([
            'titulo'=>'required',
        ]);

        $libro = Libro::find($id);
        $libro->titulo =  $request->get('titulo');
        if($request->get('ISBN') == null){
            $libro->isbn_id = 0;
        }else{
            $libro->isbns()->save($request->get('ISBN'));
        }

        $isbns = $request->get('add-isbn');
        $isbns_del = $request->get('remove-isbn');

        
        if($isbns_del != null){
            foreach($isbns_del as $isbn)
                $isbn = ISBN::find($id);
                if($isbn != null){
                    foreach($libro->isbns as $libro_isbn)
                        if (strcmp($isbn->isbn, $libro_isbn->isbn) == 0 ){ 
                            $libro->isbns()->where('id', '=', $isbn->id)->delete();
                        }
                }
        }

        if($isbns != null){
            foreach($isbns as $isbn)
                $isbn = ISBN::find($id);
                if($isbn != null){
                    foreach($libro->isbns as $libro_isbn)
                        if (strcmp($isbn->isbn, $libro_isbn->isbn) == 0 ){ 
                            $flagISBN = False;
                            }
                if($flagISBN){
                    $libro->isbns()->save($isbn);
                }
            }
        }

        $libro->save();
        
        $autors = $request->get('add-autor');
        $autors_del = $request->get('remove-autor');
        $autor_libros = autor_libros::all();
                
        if($autors_del != null){
            foreach($autors_del as $autor)
                foreach($autor_libros as $autor_libro)
                    if ($autor == $autor_libro->autor_id && Libro::find($id)->id == $autor_libro->libro_id){ 
                        $libro->autors()->detach($autor);
                    }
        }

        if($autors != null){
            foreach($autors as $autor)
                foreach($autor_libros as $autor_libro)
                    if ($autor == $autor_libro->autor_id && Libro::find($id)->id == $autor_libro->libro_id){ 
                        $flag = False;
                    }
                if($flag){
                    $libro->autors()->attach($autor);
                }
        }


        return redirect('/libros')->with('success', 'Libro updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $libro = Libro::find($id);
        $libro->autors()->detach();
        $libro->delete();

        return redirect('/libros')->with('success', 'Libro deleted!');
    }
}
