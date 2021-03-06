<?php

namespace App\Http\Controllers;

use App\Tutorial;
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

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->join('cliente', 'cliente.id', '=', 'categoria.cliente_id')->where('categoria.deleted_at', '=', null)->where('cliente.link_acesso', '=', $codigo)->get();
        $nomeCategoria = DB::table('categoria')->select('categoria.nome')->where('categoria.id', '=', $id)->value('categoria.nome');
        $cliente = DB::table('cliente')->select('cliente.nome as nomeCliente','cliente.dominio', 'cliente.link_acesso')->where('cliente.link_acesso', '=',  $codigo)->get();
        $versaoCliente = DB::table('cliente')->select('cliente.versao as versaoCliente')->where('cliente.link_acesso', '=',  $codigo)->value('cliente.versao');

        return view('site_clientes.categoria', ['categorias' => $categorias, 'codigo' => $codigo, 'nomeCategoria'=>$nomeCategoria, 'sub_categorias'=>$sub_categorias, 'cliente' => $cliente, 'versaoCliente' => $versaoCliente]);
    }

    public function subCategoria($codigo, $id)
    {


        $sub_categorias = DB::table('tutorial')->select('tutorial.*', 'tutorial.id as idTutorial', 'item_tutorial.*', 'item_tutorial.id as itemTutorialId')->join('sub_categoria', 'sub_categoria.id', '=', 'tutorial.sub_categoria_id')->join('item_tutorial', 'item_tutorial.tutorial_id', '=', 'tutorial.id')->where('tutorial.deleted_at', '=', null)->where('sub_categoria.id', '=', $id)->where('item_tutorial.foto_principal', '=', true)->get();

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->join('cliente', 'cliente.id', '=', 'categoria.cliente_id')->where('categoria.deleted_at', '=', null)->where('cliente.link_acesso', '=', $codigo)->get();
        $nomeCategoria = DB::table('categoria')->select('categoria.nome')->where('categoria.id', '=', $id)->value('categoria.nome');
        $nomeSubCategoria = DB::table('sub_categoria')->select('sub_categoria.nome')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->where('categoria.id', '=', $id)->value('categoria.nome');
        $cliente = DB::table('cliente')->select('cliente.nome as nomeCliente','cliente.dominio', 'cliente.link_acesso')->where('cliente.link_acesso', '=',  $codigo)->get();

        $versaoCliente = DB::table('cliente')->select('cliente.versao as versaoCliente')->where('cliente.link_acesso', '=',  $codigo)->value('cliente.versao');

        return view('site_clientes.sub_categoria', ['categorias' => $categorias, 'codigo' => $codigo, 'nomeCategoria' => $nomeCategoria, 'sub_categorias' => $sub_categorias, 'nomeSubCategoria'=> $nomeSubCategoria, 'id'=>$id, 'cliente' => $cliente, 'versaoCliente' => $versaoCliente]);
    }

    public function tutorial($codigo, $id)
    {


        $itemTutorial = DB::table('item_tutorial')->select('item_tutorial.*')->where('item_tutorial.tutorial_id', '=', $id)->where('item_tutorial.deleted_at', '=', null)->get();

        $tutorial = Tutorial::findOrFail($id);
        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->join('cliente', 'cliente.id', '=', 'categoria.cliente_id')->where('categoria.deleted_at', '=', null)->where('cliente.link_acesso', '=', $codigo)->get();
        $nomeCategoria = DB::table('categoria')->select('categoria.nome')->join('sub_categoria', 'sub_categoria.categoria_id', '=', 'categoria.id')->join('tutorial', 'tutorial.sub_categoria_id', 'sub_categoria.id')->where('tutorial.id', '=', $id)->value('categoria.nome');
        $nomeSubCategoria = DB::table('sub_categoria')->select('sub_categoria.nome')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('tutorial', 'tutorial.sub_categoria_id', 'sub_categoria.id')->where('tutorial.id', '=', $id)->value('sub_categoria.nome');
        $idSubCategoria = DB::table('sub_categoria')->select('sub_categoria.id')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('tutorial', 'tutorial.sub_categoria_id', 'sub_categoria.id')->where('tutorial.id', '=', $id)->value('sub_categoria.id');
        $cliente = DB::table('cliente')->select('cliente.nome as nomeCliente', 'cliente.dominio', 'cliente.link_acesso')->where('cliente.link_acesso', '=',  $codigo)->get();
        $versaoCliente = DB::table('cliente')->select('cliente.versao as versaoCliente')->where('cliente.link_acesso', '=',  $codigo)->value('cliente.versao');
        return view('site_clientes.tutorial', ['tutorial' => $tutorial, 'idSubCategoria' => $idSubCategoria,'itemTutorial'=> $itemTutorial, 'categorias' => $categorias, 'codigo' => $codigo, 'nomeCategoria' => $nomeCategoria, 'nomeSubCategoria' => $nomeSubCategoria, 'id' => $id, 'cliente' => $cliente, 'versaoCliente' => $versaoCliente]);
    }

    public function busca(Request $request, $link_acesso){

        $termo = $request->termo;


        $dadosBuscados = DB::table('tutorial')->select('tutorial.*', 'tutorial.id as idTutorial', 'categoria.nome as nomeCategoria','sub_categoria.nome as nomeSubCategoria', 'item_tutorial.*')->join('sub_categoria', 'sub_categoria.id', '=', 'tutorial.sub_categoria_id')->join('item_tutorial', 'item_tutorial.tutorial_id', '=', 'tutorial_id')->join('categoria', 'categoria.id', '=', 'sub_categoria.categoria_id')->join('cliente', 'cliente.id', 'categoria.cliente_id')->where('tutorial.titulo', 'LIKE', "%{$termo}%")->where('cliente.link_acesso', '=', $link_acesso)->where('sub_categoria.deleted_at', '=', null)->where('item_tutorial.foto_principal', '=', true)->where('tutorial.deleted_at', '=', null)->get();

        $categorias = DB::table('categoria')->select('categoria.nome', 'categoria.id')->join('cliente', 'cliente.id', '=', 'categoria.cliente_id')->where('categoria.deleted_at', '=', null)->where('cliente.link_acesso', '=', $link_acesso)->get();

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
