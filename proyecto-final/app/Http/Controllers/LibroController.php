<?php

namespace App\Http\Controllers;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\autor_libros;
use App\Models\ISBN;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        foreach ($libros as $libro) {
            $folderName = Str::slug($libro->titulo, '_') . '_' . $libro->id;
            $libro->archivos = Storage::disk('public')->files('pdfs/' . $folderName);
        }

        return view('libros.index', compact('libros', 'autors', 'isbns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $autors = Autor::all();
        return view('libros.create', compact('autors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>'required',
            'pdf.*' => 'file|max:10240',
        ]);

        

        $libro = new Libro;
        $libro->titulo = $request->get('titulo');
        if($request->get('ISBN') == null){
            $libro->isbn_id = 0;
        }else{
            $libro->isbns()->save($request->get('ISBN'));
        }
        
        $libro->save();

        $files = $request->file('pdf');
        if($request->hasFile('pdf')){
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $folderName = 'pdfs/' . Str::slug($libro->titulo, '_') . '_' . $libro->id;
                $file->storeAs('public/' . $folderName, $filename);
            }
        }
        
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

        $folderName = Str::slug($libro->titulo, '_') . '_' . $libro->id;
        $libro->archivos = Storage::disk('public')->files('pdfs/' . $folderName);

        return view('libros.edit', compact('libro', 'autors', 'isbns'));
    }

    public function update(Request $request, string $id)
    {
        $flag = True;
        $flagISBN = True;
        $request->validate([
            'titulo'=>'required',
            'pdf.*' => 'file|max:10240',
        ]);

        $libro = Libro::find($id);
        $libro->titulo =  $request->get('titulo');
        if($request->get('ISBN') == null){
            $libro->isbn_id = 0;
        }else{
            $libro->isbns()->save($request->get('ISBN'));
        }

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

        $archivos_del = $request->get('remove-pdf');
        if ($archivos_del != null) {
            foreach ($archivos_del as $archivo) {
                Storage::disk('public')->delete($archivo);
            }
        }

        $files = $request->file('add-pdf');
        
        if($request->hasFile('add-pdf')){
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $folderName = 'pdfs/' . Str::slug($libro->titulo, '_') . '_' . $libro->id;
                $file->storeAs('public/' . $folderName, $filename);
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
        $libro->isbns()->delete();

        $folderName = Str::slug($libro->titulo, '_') . '_' . $libro->id; 
        Storage::disk('public')->deleteDirectory('pdfs/' . $folderName);

        $libro->delete();

        return redirect('/libros')->with('success', 'Libro deleted!');
    }
    
    public function restoreLirbo(string $id)
    {
        $libro = Libro::withTrashed()->find($id);
        $libro->restore();
    }
    
    public function deleteLibroForever($id)
    {
        $libro = Libro::withTrashed()->find($id);

        $libro->forceDelete(); 
    }

}
