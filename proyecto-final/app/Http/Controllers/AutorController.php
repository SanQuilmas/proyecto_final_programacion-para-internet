<?php

namespace App\Http\Controllers;
use App\Models\Autor;
use App\Models\Libro;
use App\Models\autor_libros;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autors = Autor::all();

        return view('autors.index', compact('autors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('autors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nombre'=>'required',
        ]);

        $autor = new Autor;
        $autor->nombre = $request->get('nombre');
        
        $autor->save();
        return redirect('/autors')->with('success', 'Autor saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $autor = Autor::find($id);
        $libros = Libro::all();
        return view('autors.edit', compact('autor', 'libros')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $flag = True;
        $request->validate([
            'nombre'=>'required',
        ]);

        $autor = Autor::find($id);
        $autor->nombre =  $request->get('nombre');
        $autor->update();
        
        $libros = $request->get('add-libro');
        $libros_del = $request->get('remove-libro');
        $autor_libros = autor_libros::all();
                
        if($libros_del != null){
            foreach($libros_del as $libro)
                foreach($autor_libros as $autor_libro)
                    if ($autor->id == $autor_libro->autor_id && $libro == $autor_libro->libro_id){ 
                        $autor->libros()->detach($libro);
                    }
        }

        if($libros != null){
            foreach($libros as $libro)
                foreach($autor_libros as $autor_libro)
                    if ($autor->id == $autor_libro->autor_id && $libro == $autor_libro->libro_id){ 
                        $flag = False;
                    }
                if($flag){
                    $autor->libros()->attach($libro);
                }
        }

        return redirect('/autors')->with('success', 'Autor updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $autor = Autor::find($id);
        $autor->libros()->detach();
        $autor->delete();

        return redirect('/autors')->with('success', 'Autor deleted!');
    }
}
