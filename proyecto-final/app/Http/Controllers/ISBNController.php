<?php

namespace App\Http\Controllers;
use App\Models\ISBN;
use App\Models\Libro;

use Illuminate\Http\Request;

class ISBNController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isbns = ISBN::all();

        return view('isbns.index', compact('isbns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros = Libro::all();
        return view('isbns.create', compact('libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
        ]);

        $isbn = new ISBN;
        $isbn->nombre = $request->get('nombre');
        $isbn->save();
        
        return redirect('/isbns')->with('success', 'ISBN saved!');
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
        $isbn = ISBN::find($id);
        return view('isbns.edit', compact('isbn')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre'=>'required',
        ]);

        $isbn = ISBN::find($id);
        $isbn->nombre =  $request->get('nombre');
        $isbn->save();

        return redirect('/isbns')->with('success', 'ISBN updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isbn = ISBN::find($id);
        $isbn->delete();

        return redirect('/isbns')->with('success', 'ISBN deleted!');
    }
}
