<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Bloque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::with('bloque')->get()->groupBy('bloque_id');
        $bloques = Bloque::all();
        return view('admin.categorias.index', compact('categorias', 'bloques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bloques = Bloque::all();
        return view('admin.categorias.create', compact('bloques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'bloque_id' => 'required|exists:bloques,id',
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);
    
        // Crear una nueva instancia de Categoria con los datos del formulario
        $categoria = new Categoria();
        $categoria->bloque_id = $request->input('bloque_id');
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->save();
    
        // Redireccionar al usuario de vuelta a la lista de categorias
        return redirect()->route('admin.categoria.index')
                         ->with('success', 'La categoria se ha creado exitosamente.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show',compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);
        $categoria->update($request->all());
        return redirect()->route('admin.categoria.index')
                         ->with('success', 'La categoria se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('admin.categoria.index')
                         ->with('success', 'La categoria se ha eliminado exitosamente.');
    }

    public function exportToJson()
    {
        try {
            // Obtener los datos del modelo
            $categorias = Categoria::all();

            // Convertir los datos a formato JSON
            $json = $categorias->toJson();

            // Definir la ruta del archivo
            $file = public_path('data/categorias.json');

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
                return redirect()->route('admin.categoria.index')->with('success', 'El archivo se ha exportado correctamente.');
            } else {
                throw new \Exception('Ha ocurrido un error al exportar el archivo');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.categoria.index')->with('success', $e->getMessage());
        }
    }
}
