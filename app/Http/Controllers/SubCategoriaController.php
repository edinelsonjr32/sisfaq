<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\SubCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categorias = DB::table('sub_categoria')->select('sub_categoria.*', 'categoria.nome as nomeCategoria')->join('categoria','categoria.id', 'sub_categoria.categoria_id')->where('sub_categoria.deleted_at', '=', null)->get();



        $categorias = Categoria::all();
        return view('sub_categorias.index', ['sub_categorias' => $sub_categorias, 'categorias'=>$categorias]);
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
    public function store(Request $request, SubCategoria  $subCategoria)
    {
        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required'
        ]);
        $subCategoria->nome = $request->nome;
        $subCategoria->categoria_id = $request->categoria_id;
        if ($subCategoria->save()) {
            return redirect()->route('sub_categoria.index');
        }else {
            return redirect()->route('sub_categoria.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategoria $subCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategoria = SubCategoria::findOrFail($id);
        $categorias = Categoria::all();

        return view('sub_categorias.edit', ['subCategoria' => $subCategoria, 'categorias'=> $categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subCategoria = SubCategoria::findOrFail($id);

        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required'
        ]);

        $subCategoria->nome = $request->nome;
        $subCategoria->categoria_id = $request->categoria_id;

        if ($subCategoria->update()) {
            return redirect()->route('sub_categoria.index');
        } else {
            return redirect()->route('sub_categoria.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategoria = SubCategoria::findOrFail($id);


        if ($subCategoria->delete()) {
            return redirect()->route('sub_categoria.index');
        }else{
            return redirect()->route('sub_categoria.index');
        }
    }
}
