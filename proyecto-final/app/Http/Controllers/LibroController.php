<?php

namespace App\Http\Controllers;
use App\Models\Libro;

use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::all();

        return view('libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>'required',
            'ISBN'=>'required',
            'autor'=>'required'
        ]);

        $libro = new Libro([
            'titulo' => $request->get('titulo'),
            'ISBN' => $request->get('ISBN'),
            'autor' => $request->get('autor')
        ]);
        $libro->save();
        return redirect('/libros')->with('success', 'Libro saved!');
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
        
        $libro = Libro::find($id);
        return view('libros.edit', compact('libro')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo'=>'required',
            'ISBN'=>'required',
            'autor'=>'required'
        ]);

        $libro = Libro::find($id);
        $libro->titulo =  $request->get('titulo');
        $libro->ISBN = $request->get('ISBN');
        $libro->autor = $request->get('autor');
        $libro->save();

        return redirect('/libros')->with('success', 'Libro updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $libro = Libro::find($id);
        $libro->delete();

        return redirect('/libros')->with('success', 'Libro deleted!');
    }
}
