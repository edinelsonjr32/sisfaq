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

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->join('cliente', 'cliente.id', '=', 'categoria.cliente_id')->where('categoria.deleted_at', '=', null)->where('cliente.link_acesso', '=', $codigo)->get();

        $cliente = DB::table('cliente')->select('cliente.nome as nomeCliente', 'cliente.dominio', 'cliente.link_acesso')->where('cliente.link_acesso', '=',  $codigo)->get();
        $versaoCliente = DB::table('cliente')->select('cliente.versao as versaoCliente')->where('cliente.link_acesso', '=',  $codigo)->value('cliente.versao');
        return view('site_clientes.index', ['categorias' => $categorias, 'codigo'=>$codigo, 'cliente'=>$cliente, 'versaoCliente'=> $versaoCliente]);
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
        $cliente = DB::table('cliente')->select('cliente.nome as nomeCliente','cliente.dominio', 'cliente.link_acesso')->where('cliente.link_acesso', '=',  $codigo)->get();
        $versaoCliente = DB::table('cliente')->select('cliente.versao as versaoCliente')->where('cliente.link_acesso', '=',  $codigo)->value('cliente.versao');

        return view('site_clientes.categoria', ['categorias' => $categorias, 'codigo' => $codigo, 'nomeCategoria'=>$nomeCategoria, 'sub_categorias'=>$sub_categorias, 'cliente' => $cliente, 'versaoCliente' => $versaoCliente]);
    }

    public function subCategoria($codigo, $id)
    {

        $sub_categorias = DB::table('sub_categoria')->select('tutorial.*')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('tutorial', 'tutorial.sub_categoria_id', '=', 'sub_categoria.id')->where('sub_categoria.id', '=', $id)->orderBy('tutorial.passo_numero')->get();

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->where('deleted_at', '=', null)->get();
        $nomeCategoria = DB::table('categoria')->select('categoria.nome')->where('categoria.id', '=', $id)->value('categoria.nome');
        $nomeSubCategoria = DB::table('sub_categoria')->select('sub_categoria.nome')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->where('categoria.id', '=', $id)->value('categoria.nome');
        $cliente = DB::table('cliente')->select('cliente.nome as nomeCliente','cliente.dominio', 'cliente.link_acesso')->where('cliente.link_acesso', '=',  $codigo)->get();
        $versaoCliente = DB::table('cliente')->select('cliente.versao as versaoCliente')->where('cliente.link_acesso', '=',  $codigo)->value('cliente.versao');

        return view('site_clientes.sub_categoria', ['categorias' => $categorias, 'codigo' => $codigo, 'nomeCategoria' => $nomeCategoria, 'sub_categorias' => $sub_categorias, 'nomeSubCategoria'=> $nomeSubCategoria, 'id'=>$id, 'cliente' => $cliente, 'versaoCliente' => $versaoCliente]);
    }

    public function busca(Request $request, $link_acesso){

        $termo = $request->termo;


        $dadosBuscados = DB::table('sub_categoria')->select('sub_categoria.*', 'categoria.nome as nomeCategoria')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id', 'categoria.cliente_id')->where('sub_categoria.nome', 'LIKE', "%{$termo}%")->where('cliente.link_acesso', '=', $link_acesso)->where('sub_categoria.deleted_at', '=', null)->get();

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->where('deleted_at', '=', null)->get();

        $cliente = DB::table('cliente')->select('cliente.nome as nomeCliente', 'cliente.dominio', 'cliente.link_acesso')->where('cliente.link_acesso', '=',  $link_acesso)->get();
        $versaoCliente = DB::table('cliente')->select('cliente.versao as versaoCliente')->where('cliente.link_acesso', '=',  $link_acesso)->value('cliente.versao');
        return view('site_clientes.busca', ['termo' => $termo,'categorias' => $categorias, 'dadosBuscados'=> $dadosBuscados, 'codigo' => $link_acesso, 'cliente' => $cliente, 'versaoCliente' => $versaoCliente]);
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
