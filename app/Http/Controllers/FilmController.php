<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::orderby('id', 'desc')->paginate(7);
        return view('film.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags1 = Tag::select('id', 'nombre')->orderby('nombre')->get();
        return view('film.crear', compact('tags1'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['string', 'required', 'min:3', 'unique:films,titulo'],
            'descripcion' => ['string', 'required', 'min:10'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'tags' => ['required', 'array', 'min:1', 'exists:tags,id']
        ]);
        $pelicula = Film::create([
            'titulo' => ucfirst($request->titulo),
            'descripcion' => ucfirst($request->descripcion),
            'imagen' => ($request->imagen) ? $request->imagen->store('films') : 'films/default.jpg'
        ]);
        $pelicula->tags()->attach($request->tags); //IMPORTANTE
        return redirect()->route('films.index')->with('info', 'Pelicula creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        $idTagFilm = $film->devolverIdTags();
        return view('film.info', compact('film', 'idTagFilm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $idTagFilm = $film->devolverIdTags();
        $tags = Tag::select('id', 'nombre')->orderby('nombre')->get();
        return view('film.editar', compact('film', 'tags', 'idTagFilm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'titulo' => ['string', 'required', 'min:3', 'unique:films,titulo,'.$film->id],
            'descripcion' => ['string', 'required', 'min:10'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'tags' => ['required', 'min:1', 'array', 'exists:tags,id']
        ]);
        $ruta = $film->imagen;
        if ($request->imagen){
            $ruta = $request->imagen->store('films');
            if (basename($film->imagen) != 'default.jpg') {
                Storage::delete($film->imagen);
            }
        }
        $film->update([
            'titulo' => ucfirst($request->titulo),
            'descripcion' => ucfirst($request->descripcion),
            'imagen' => $ruta
        ]);
        $film->tags()->sync($request->tags);
        return redirect()->route('films.index')->with('info', 'Pelicula actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        if (basename($film->imagen) != 'default.webp') {
            Storage::delete($film->imagen);
        }
        $film->delete();
        return redirect()->route('films.index')->with('info', 'Pelicula eliminada');
    }
}
