<?php

namespace App\Http\Controllers;
use App\Models\Autor;

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

        $autor = new Autor([
            'nombre' => $request->get('nombre'),
        ]);
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
        return view('autors.edit', compact('autor')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre'=>'required',
        ]);

        $autor = Autor::find($id);
        $autor->nombre =  $request->get('nombre');
        $autor->save();

        return redirect('/autors')->with('success', 'Autor updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $autor = Autor::find($id);
        $autor->delete();

        return redirect('/autors')->with('success', 'Autor deleted!');
    }
}
