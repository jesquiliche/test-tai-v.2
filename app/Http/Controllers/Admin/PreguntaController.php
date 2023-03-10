<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Pregunta;
use Illuminate\Support\Facades\File;
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

    public function exportToJson()
    {
        try {
            // Obtener los datos del modelo
            $preguntas = Pregunta::all();

            // Convertir los datos a formato JSON
            $json = $preguntas->toJson();

            // Definir la ruta del archivo
            $file = public_path('data/preguntas.json');

            // Comprobar si el archivo ya existe
            if (File::exists($file)) {
                // Reemplazar el archivo si ya existe
                File::replace($file, $json);
            } else {
                // Crear el archivo si no existe
                File::put($file, $json);
            }

            // Verificar que el archivo se haya creado o reemplazado
            if (File::exists($file)) {
                return redirect()->route('admin.pregunta.index')->with('success', 'El archivo se ha exportado correctamente.');
            } else {
                throw new \Exception('Ha ocurrido un error al exportar el archivo');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.pregunta.index')->with('success', $e->getMessage());
        }
    }
}
