<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bloque;
use Psy\Command\EditCommand;

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
}
