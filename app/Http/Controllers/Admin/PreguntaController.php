<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Pregunta;

use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = Categoria::with('bloque')->get();

        $preguntas = Pregunta::query();

        if ($request->has('categoria_id')) {
            $preguntas->where('categoria_id', $request->categoria_id);
        }

        $preguntas = $preguntas->paginate(1000);

        return view('admin.preguntas.index', compact('preguntas', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.preguntas.create', compact('categorias'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pregunta' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'respuesta' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

    

        Pregunta::create($validatedData);

        return redirect()->route('admin.pregunta.index')
            ->with('success', 'La pregunta ha sido creada con éxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregunta $pregunta)
    {
        $categorias = Categoria::all()->pluck('nombre', 'id');
        $respuestas = ['a', 'b', 'c', 'd'];

        return view('admin.preguntas.edit', compact('pregunta', 'categorias', 'respuestas'));
    }

    public function update(Request $request, Pregunta $pregunta)
    {
        $request->validate([
            'pregunta' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'respuesta' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'explicacion' => 'nullable',
        ]);

        $pregunta->update($request->all());

        return redirect()->route('admin.pregunta.index')
            ->with('success', 'La pregunta ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pregunta $pregunta)
    {


        $pregunta->delete();

        return redirect()->route('admin.pregunta.index')->with('success', 'La pregunta ha sido eliminada correctamente.');
    }
}
