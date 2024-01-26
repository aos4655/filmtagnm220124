<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use LVR\Colour\Hex;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderby('id', 'desc')->paginate(5);
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'unique:tags,nombre'],
            'color' => ['required', new Hex]
        ]);
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('info', 'Etiqueta creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('tag.info', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tag.editar', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'unique:tags,nombre,'.$tag->id],
            'color' => ['required', new Hex]
        ]);
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('info', 'Etiqueta actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('info', 'Etiqueta eliminada con exito');
    }
}
