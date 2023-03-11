<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bloque;
use Psy\Command\EditCommand;
use Illuminate\Support\Facades\File;

class BloqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        $bloques = Bloque::all();

        return view('admin.bloques.index', compact('bloques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bloques.create');
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
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $bloque = new Bloque();
        $bloque->nombre = $validatedData['nombre'];
        $bloque->descripcion = $validatedData['descripcion'];
        $bloque->save();

        return redirect()->route('admin.bloque.index')->with('success', 'El bloque se ha creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bloque  $bloque
     * @return \Illuminate\Http\Response
     */
    public function show(Bloque $bloque)
    {
        return view('admin.bloque.show', compact('bloque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bloque  $bloque
     * @return \Illuminate\Http\Response
     */
    public function edit(Bloque $bloque)
    {
        return view('admin.bloques.edit', compact('bloque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bloque  $bloque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bloque $bloque)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);
        $bloque->update($request->all());
        return redirect()->route('admin.bloque.index')->with('success', 'El bloque se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bloque  $bloque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bloque $bloque)
    {
        $bloque->delete();
        return redirect()->route('admin.bloque.index')->with('success', 'El bloque se ha eliminado exitosamente.');
    }

    public function exportToJson()
    {
        try {
            // Obtener los datos del modelo
            $bloques = Bloque::all();

            // Convertir los datos a formato JSON
            $json = $bloques->toJson();

            // Definir la ruta del archivo
            $file = public_path('data/bloques.json');

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
            return redirect()->route('admin.bloque.index')->with('success', $e->getMessage());
        }
    }
}
