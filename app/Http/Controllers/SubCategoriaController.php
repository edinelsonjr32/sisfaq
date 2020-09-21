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
            return redirect()->route('cliente.show', $request->cliente_id);
        }else {
            return redirect()->route('cliente.show', $request->cliente_id);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $subCategoria = DB::table('sub_categoria')->select('sub_categoria.*', 'categoria.nome as nomeCategoria', 'cliente.nome as nomeCliente', 'cliente.id as cliente_id')->join('categoria', 'categoria.id', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id', '=', 'categoria.cliente_id')->where('sub_categoria.id', '=', $id)->get();


        $tutorial = DB::table('tutorial')->select('tutorial.*', 'tutorial.id as idTutorial','item_tutorial.*' , 'item_tutorial.id as itemTutorialId')->join('sub_categoria', 'sub_categoria.id', '=', 'tutorial.sub_categoria_id')->join('item_tutorial', 'item_tutorial.tutorial_id', '=', 'tutorial.id')->where('tutorial.deleted_at', '=', null)->where('sub_categoria.id', '=', $id)->where('item_tutorial.foto_principal','=', true)->get();

        $cliente_id = DB::table('sub_categoria')->select('cliente.id as cliente_id')->join('categoria', 'categoria.id','=','sub_categoria.categoria_id')->join('cliente','cliente.id', '=', 'categoria.cliente_id')->where('sub_categoria.id', '=', $id)->value('cliente.id');

        return view('sub_categorias.show', compact('subCategoria', 'tutorial', 'cliente_id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategoria = DB::table('sub_categoria')->select('sub_categoria.*', 'cliente.id as cliente_id')->join('categoria', 'categoria.id', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id','categoria.cliente_id')->where('sub_categoria.id', $id)->get();

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
        $cliente_id = $request->cliente_id;

        if ($subCategoria->update()) {
            return redirect()->route('cliente.show', $cliente_id);
        } else {
            return redirect()->route('cliente.show', $cliente_id);
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
        $cliente_id = DB::table('sub_categoria')->select('cliente.id as cliente_id')->join('categoria', 'categoria.id', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id', 'categoria.cliente_id')->where('sub_categoria.id', $id)->value('cliente.id');
        if ($subCategoria->delete()) {
            return redirect()->route('cliente.show', $cliente_id);
        }else{
            return redirect()->route('cliente.show', $cliente_id);
        }
    }
}
