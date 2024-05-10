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
        $libro = Libro::with('isbns')->get();
        $isbns = ISBN::all();

        return view('isbns.index', compact('isbns'), compact('libro'));
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
            'isbn'=>'required',
            'libro'=>'required',
        ]);

        $isbn = new ISBN;
        $isbn->isbn = $request->get('isbn');
        $libro = $request->get('libro');
        $isbn->libro()->associate($libro);
        $isbn->save();
        

        return redirect('/isbn')->with('success', 'ISBN saved!');
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
        $libros = Libro::all();
        $isbn = ISBN::find($id);
        return view('isbns.edit', compact('isbn'), compact('libros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'isbn'=>'required',
            'libro'=>'required',
        ]);

        $isbn = ISBN::find($id);
        $isbn->isbn = $request->get('isbn');
        $libro = $request->get('libro');
        $isbn->libro()->associate($libro);
        $isbn->save();

        return redirect('/isbn')->with('success', 'ISBN updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isbn = ISBN::find($id);
        $isbn->delete();

        return redirect('/isbn')->with('success', 'ISBN deleted!');
    }
}
