<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codigo)
    {

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->where('deleted_at', '=', null)->get();

        return view('site_clientes.index', ['categorias' => $categorias, 'codigo'=>$codigo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoria($codigo , $id)
    {


        $sub_categorias = DB::table('sub_categoria')->select('sub_categoria.*')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->where('categoria.id', '=', $id)->get();

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->where('deleted_at', '=', null)->get();
        $nomeCategoria = DB::table('categoria')->select('categoria.nome')->where('categoria.id', '=', $id)->value('categoria.nome');
        return view('site_clientes.categoria', ['categorias' => $categorias, 'codigo' => $codigo, 'nomeCategoria'=>$nomeCategoria, 'sub_categorias'=>$sub_categorias]);
    }

    public function subCategoria($codigo, $id)
    {

        $sub_categorias = DB::table('sub_categoria')->select('tutorial.*')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('tutorial', 'tutorial.sub_categoria_id', '=', 'sub_categoria.id')->where('sub_categoria.id', '=', $id)->orderBy('tutorial.passo_numero')->get();

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->where('deleted_at', '=', null)->get();
        $nomeCategoria = DB::table('categoria')->select('categoria.nome')->where('categoria.id', '=', $id)->value('categoria.nome');
        $nomeSubCategoria = DB::table('sub_categoria')->select('sub_categoria.nome')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->where('categoria.id', '=', $id)->value('categoria.nome');
        return view('site_clientes.sub_categoria', ['categorias' => $categorias, 'codigo' => $codigo, 'nomeCategoria' => $nomeCategoria, 'sub_categorias' => $sub_categorias, 'nomeSubCategoria'=> $nomeSubCategoria]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
