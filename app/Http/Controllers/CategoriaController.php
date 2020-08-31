<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Categoria $categoria)
    {
        return view('categorias.index', ['categoria' => $categoria->Where()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome'=> 'required'
        ]);

        if ($categoria->create($request->all())) {
            return redirect()->route('cliente.show', $request->cliente_id);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome'=> 'required'
        ]);
        $cliente_id = $request->cliente_id;
        $categoria = Categoria::findOrFail($id);
        if ($categoria->update($request->all())) {
            return redirect()->route('cliente.show', $cliente_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $categoria = Categoria::findOrFail($id);
        $cliente_id = $categoria->cliente_id;
        if ($categoria->delete()) {
            return redirect()->route('cliente.show', $cliente_id);
        }
    }
}
